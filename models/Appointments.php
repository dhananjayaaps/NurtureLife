<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\models\Mother;
use PDO;

class Appointments extends DbModel
{
    public string $AppointmentId = '';
    public string $MotherId = '';
    public int $AppointType = 1;
    public string $AppointDate = '';
    public string $AppointStatus = '';
    public string $AppointRemarks = '';
    public string $time = '';

    public function tableName(): string
    {
        return 'Appointments';
    }

    public function attributes(): array
    {
        return [
            'MotherId',
            'AppointType',
            'AppointDate',
            'AppointStatus',
            'AppointRemarks',
            'time'
        ];
    }

    public function primaryKey(): string
    {
        return 'AppointmentId';
    }

    public function rules(): array
    {
        return [
            'MotherId' => [self::RULE_REQUIRED],
            'AppointType' => [self::RULE_REQUIRED],
            'AppointDate' => [self::RULE_REQUIRED],
            'AppointStatus' => [self::RULE_REQUIRED],
            'time' => [self::RULE_REQUIRED],
        ];
    }

    public function getMothersForMidwife() {
        $sql = "SELECT Mothers.MotherId, users.firstname, users.city, users.lastname, Mothers.Status, Mothers.DeliveryDate, Mothers.PHM_ID FROM Mothers INNER JOIN users ON Mothers.user_id = users.id INNER JOIN midwife ON Mothers.PHM_ID = midwife.PHM_id WHERE midwife.user_id = 1";

        $stmt = self::prepare($sql);
        $stmt->execute();
        $motherData = $stmt->fetchAll(PDO::FETCH_OBJ);
        $statusNames = ['Inactive', 'Prenatal', 'Postnatal', 'Both', 'Special'];
        $data2 = [];


        foreach ($motherData as $mother) {
            $data2[] = [
                'MotherId' => $mother->MotherId,
                'Name' => $mother->firstname . " " . $mother->lastname,
                'Status' => $statusNames[(int)$mother->Status],
                'City' => $mother->city,
                'DeliveryDate' => $mother->DeliveryDate,
                'PHM_id' => $mother->PHM_ID,
            ];
        }
        return json_encode($data2);
    }

    public function getAllAppointmentsForMidwife(): false|string
    {
        $sql = "SELECT Appointments.AppointmentId, Mothers.MotherId, users.firstname, users.city, users.lastname, Mothers.Status, Mothers.DeliveryDate, Mothers.PHM_ID, Appointments.AppointType, Appointments.AppointDate, Appointments.AppointStatus, Appointments.AppointRemarks, Appointments.time FROM Appointments INNER JOIN Mothers ON Appointments.MotherId = Mothers.MotherId INNER JOIN users ON Mothers.user_id = users.id INNER JOIN midwife ON Mothers.PHM_ID = midwife.PHM_id WHERE midwife.user_id = 1";

        $stmt = self::prepare($sql);
        $stmt->execute();
        $appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
        $statusNames = ['Inactive', 'Prenatal', 'Postnatal', 'Both', 'Special'];
        $appointTypeNames = ['Antenatal', 'Postnatal', 'Special', 'Other'];
        $data = [];

        foreach ($appointmentData as $appointment) {
            $data[] = [
                'AppointmentId' => $appointment->AppointmentId,
                'MotherId' => $appointment->MotherId,
                'Name' => $appointment->firstname . " " . $appointment->lastname,
                'Status' => $statusNames[(int)$appointment->Status],
                'City' => $appointment->city,
                'DeliveryDate' => $appointment->DeliveryDate,
                'PHM_id' => $appointment->PHM_ID,
                'AppointType' => $appointTypeNames[(int)$appointment->AppointType],
                'AppointDate' => $appointment->AppointDate,
                'AppointStatus' => $appointment->AppointStatus,
                'AppointRemarks' => $appointment->AppointRemarks,
                'time' => $appointment->time
            ];
        }
        return json_encode($data);
    }

    //delete appoinmets by sending appointments id list, this is used in the delete appointments page. the appointment is must be done by the associated midwife
    public function deleteAppointments($appointments): bool
    {
        $sql = "DELETE FROM Appointments WHERE AppointmentId IN (";
        $sql .= implode(',', array_map(fn($id) => $id, $appointments));
        $sql .= ") AND MotherId IN (SELECT MotherId FROM Mothers WHERE PHM_ID = (SELECT PHM_id FROM midwife WHERE user_id = 1))";

        $stmt = self::prepare($sql);
        $stmt->execute();
        return true;
    }

    public function deleteByAppointmentId(): bool
    {
        try {
            $sql = "DELETE FROM Appointments WHERE AppointmentId = :AppointmentId";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':AppointmentId', $this->AppointmentId);
            $stmt->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    //make a update to the appointment details by sending the appointment model
    public function update(): bool
    {
        $sql = "UPDATE Appointments SET AppointDate = :AppointDate, AppointRemarks = :AppointRemarks, time = :time WHERE AppointmentId = :AppointmentId AND MotherId IN (SELECT MotherId FROM Mothers WHERE PHM_ID = (SELECT PHM_id FROM midwife WHERE user_id = 1))";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':AppointDate', $this->AppointDate);
        $stmt->bindValue(':AppointRemarks', $this->AppointRemarks);
        $stmt->bindValue(':time', $this->time);
        $stmt->bindValue(':AppointmentId', $this->AppointmentId);
        $stmt->execute();
        return true;
    }

    public function cancelAppointment($appointmentId): bool
    {
        $sql = "UPDATE Appointments SET AppointStatus = 1 WHERE AppointmentId = :AppointmentId AND MotherId IN (SELECT MotherId FROM Mothers WHERE PHM_ID = (SELECT PHM_id FROM midwife WHERE user_id = 1))";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':AppointmentId', $appointmentId);
        $stmt->execute();
        return true;
    }
    public function getAppointmentsByMotherId(): string
    {
        $MotherId = ( new Mother())->getMotherId();
        $appointments = ( new Appointments())->findAll(self::class, ['MotherId'=>$MotherId, 'AppointStatus'=> 1 ]);
        $data = [];

        foreach ($appointments as $appointData) {
            $data[] = [
                'Type' => $appointData->AppointType,
                'Date' => $appointData->AppointDate,
                'Remarks' => $appointData->AppointRemarks
            ];
        }
        return json_encode($data);
    }
}