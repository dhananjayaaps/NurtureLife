<?php
namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\models\Doctor;
use app\models\Midwife;
use PDO;


class MotherSymptoms extends DbModel
{
    public string $symptomRecNo = '';
    public string $MotherId = '';
    public string $clinicId = '';
    public string $symptomDescription = '';
    public string $priorityLvl = '';
    public string $recTime = '';
    public string $midwifeId = '';
    public string $midwifeCheck = 'No';
    public string $replyDocId = '';
    public string $doctorReply = '';
    public string $replyTime = '';

    public function rules(): array
    {
        return[

            'symptomDescription'=> [self::RULE_REQUIRED]
//            'doctorReply'=> [self::RULE_REQUIRED]
        ];
    }

    public function tableName(): string
    {
        return 'MotherSymptoms';
    }

    public function primaryKey(): string
    {
        return 'symptomRecNo';
    }

    public function attributes(): array
    {
        return [
            'MotherId',
            'clinicId',
            'symptomDescription',
            'priorityLvl',
            'recTime',
            'midwifeId',
            'midwifeCheck',
            'replyDocId',
            'doctorReply',
            'replyTime'
        ];
    }

    public function save(): bool
    {
        $UserId = Application::$app->user->getId();
        $MotherData = Mother::class::findOne(Mother::class, ['user_id' => $UserId]);
        $this->MotherId = $MotherData->MotherId;
        $this->clinicId = $MotherData->clinic_id;
        $this->midwifeId = $MotherData->PHM_ID;
        $this->recTime = date('Y-m-d H:i:s');
        return parent::save();
    }

    public function getMomRecords()
    {
        $motherId = (new Mother())->getMotherId();
        $momRecords = (new MotherSymptoms())->findAll(self::class,['MotherId' => $motherId]);
        return json_encode($momRecords);
    }

    public function getARec($id)
    {
        return (new MotherSymptoms())->findOne(self::class, ['symptomRecNo' => $id]);
    }

    public function getSymptomsByDoctor() {
        $DocId = (new Doctor())->getDocId();


        // Assuming $pdo is your PDO object
        $sql = self::prepare("SELECT M.*
                     From doctors AS D, MotherSymptoms AS M 
                     WHERE D.MOH_id = :doctorId AND D.clinic_id = M.clinicId");

        $sql->bindValue(":doctorId", $DocId);
        $sql->execute();

        // Fetch all rows as associative arrays
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Return the result as JSON
        return json_encode($result);
    }
    public function getSymptomsByMidwife() {
        $MidwifeId = (new Midwife())->getMidwifeId();


        // Assuming $pdo is your PDO object
        $sql = self::prepare("SELECT *
                     From MotherSymptoms AS M 
                     WHERE M.midwifeId = :midwifeId");

        $sql->bindValue(":midwifeId", $MidwifeId);
        $sql->execute();

        // Fetch all rows as associative arrays
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Return the result as JSON
        return json_encode($result);
    }


}