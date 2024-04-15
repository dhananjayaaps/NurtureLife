<link rel="stylesheet" href="/assets/styles/profile.css">
<div class="mother_details_container">
    <h2>About Mother</h2>
    <div class="mother_details_row">
<!--        these are hardcoded-->
        User ID: <?= 001?>
    </div>
    <div class="mother_details_row">
        Name: <?= "Sineth Dananjaya" ?>
    </div>
    <div class="mother_details_row">
        Email: <?= "sineth@gmail.com" ?>
    </div>
    <div class="mother_details_row">
        Contact No: <?= "0719773264" ?>
    </div>
    <div class="mother_details_row">
        Clinic: <?= "Nugegoda" ?>
    </div>
    <div class="mother_details_row">
        Midwife: <?= "Sineth Dananjaya" ?>
    </div>
    <div class="mother_details_row">
        Doctor: <?= "Dr. Jason" ?>
    </div>
    <div class="mother_details_row">
        MOH area: <?= "Nugegoda" ?>
    </div>
    <div class="mother_details_row">
<!--        Status: --><?php
//        if ($row->status == 1) {
//            echo "Prenatal";
//        } elseif ($row->status == 2) {
//            echo "Postnatal";
//        } else {
//            echo "Inactive";
//        }
//        ?>
        Status: <?= "Prenatal" ?>
    </div>
    <div class="mother_details_row">
<!--        Blood Group: --><?php
//        if (!empty($row->bloodGroup)) {
//            switch ($row->bloodGroup) {
//                case 1:
//                    echo "A RhD positive (A+)";
//                    break;
//                case 2:
//                    echo "A RhD negative (A-)";
//                    break;
//                case 3:
//                    echo "B RhD positive (B+)";
//                    break;
//                case 4:
//                    echo "B RhD negative (B-)";
//                    break;
//                case 5:
//                    echo "O RhD positive (O+)";
//                    break;
//                case 6:
//                    echo "O RhD negative (O-)";
//                    break;
//                case 7:
//                    echo "AB RhD positive (AB+)";
//                    break;
//                case 8:
//                    echo "AB RhD negative (AB-)";
//                    break;
//                default:
//                    echo "Unknown Blood Group";
//            }
//        } else {
//            echo "Blood Group not specified";
//        }
//        ?>
        Blood group: <?= "AB RhD negative (AB-)" ?>
    </div>
    <div class="mother_details_row">

        Allergies: <?= "None" ?>
    </div>
    <div class="mother_details_row">
<!--        GPS Location: <a target="_blank" href="--><?php //= esc($row->gps_location) ?><!--">--><?php //= esc($row->gps_location) ?><!--</a>-->
        GPS location: https://maps.app.goo.gl/B3mNN2AtSd7YjG3RA
    </div>
    <div class="mother_details_row">
        Emergency Contact No: <?= "0719773264" ?>
    </div>
    <div class="mother_details_row">
        Created User: <?= "Chethiya Wanigarathne" ?>
    </div>
    <div class="mother_details_row">
        Created On: <?= "2024-02-20" ?>
    </div>

</div>
<br>