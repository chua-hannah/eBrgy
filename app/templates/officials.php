<div class="container mt-5 mb-5">
    <div class="container text-center">
        <div>
            <h2 class="mb-4">We are the Barangay 95 Officials</h2>
        </div>

        <div class="row d-flex justify-content-center">
            <?php
            $positions = ['treasurer', 'captain', 'secretary']; // Add more positions as needed
            foreach ($positions as $position):
            ?>
            <div class="col-md-4">
                <div class="card custom-card md-3 mb-4">
                    <div class="card-body d-flex justify-content-center align-items-center text-center">
                        <div class="container" style="min-height: 300px;">
                            <?php
                            $foundOfficial = false;
                            foreach ($officials as $official):
                                if ($official['position'] === $position):
                                    $foundOfficial = true;
                                    $idSelfiePath = 'uploads/id_selfie/' . $official['id_selfie'];
                            ?>
                            <!-- Display the ID Selfie image -->
                            <div class="d-flex flex-column align-items-center">
                                <?php if (!empty($official['id_selfie']) && file_exists($idSelfiePath)): ?>
                                    <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail" style="width: 200px; height: 200px;">
                                <?php else: ?>
                                    <p>ID Selfie not available</p>
                                <?php endif; ?>
                            </div>
                            <h6 class="card-title mt-2 mb-0" style="color: #0037ab">
                                <?php echo strtoupper($official['firstname'] . ' ' . $official['middlename'] . ' ' . $official['lastname']); ?>
                            </h6>
                            <strong><?php echo strtoupper($official['position'] == 'captain' ? 'Chairman' : $official['position']); ?></strong>
                            <?php
                                break;
                            endif;
                            endforeach;

                            if (!$foundOfficial) {
                                echo "<p>No $position available</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row d-flex justify-content-center">
            <?php
            $positions = ['councilor', 'councilor', 'councilor', 'councilor', 'councilor', 'councilor', 'exo1',  'councilor', 'exo2']; 
            $officialsByPosition = [];

            foreach ($officials as $official) {
                $officialsByPosition[$official['position']][] = $official;
            }

            foreach ($positions as $position):
            ?>
            <div class="col-md-4">
                <div class="card custom-card md-3 mt-4 mb-4">
                    <div class="card-body d-flex justify-content-center align-items-center text-center">
                        <div class="container" style="min-height: 300px;">
                            <?php
                            if (!empty($officialsByPosition[$position])) {
                                $official = array_shift($officialsByPosition[$position]);
                                $idSelfiePath = 'uploads/id_selfie/' . $official['id_selfie'];
                            ?>
                            <!-- Display the ID Selfie image -->
                            <div class="d-flex flex-column align-items-center">
                                <?php if (!empty($official['id_selfie']) && file_exists($idSelfiePath)): ?>
                                    <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail" style="width: 200px; height: 200px;">
                                <?php else: ?>
                                    <p>ID Selfie not available</p>
                                <?php endif; ?>
                            </div>
                            <h6 class="card-title mt-2 mb-0" style="color: #0037ab">
                                <?php echo strtoupper($official['firstname'] . ' ' . $official['middlename'] . ' ' . $official['lastname']); ?>
                            </h6>
                            <strong><?php echo strtoupper($official['position']); ?></strong>
                            <?php
                            } else {
                                echo "<p>No $position available</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row d-flex justify-content-center">
            <?php
            $positions = ['skchairman', 'skcouncilor', 'sksecretary', 'sktreasurer']; // Add more positions as needed
            foreach ($positions as $position):
            ?>
            <div class="col-md-3">
                <div class="card custom-card md-3 mb-4">
                    <div class="card-body d-flex justify-content-center align-items-center text-center">
                        <div class="container" style="min-height: 300px;">
                            <?php
                            $foundOfficial = false;
                            foreach ($officials as $official):
                                if ($official['position'] === $position):
                                    $foundOfficial = true;
                                    $idSelfiePath = 'uploads/id_selfie/' . $official['id_selfie'];
                            ?>
                            <!-- Display the ID Selfie image -->
                            <div class="d-flex flex-column align-items-center">
                                <?php if (!empty($official['id_selfie']) && file_exists($idSelfiePath)): ?>
                                    <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail" style="width: 200px; height: 200px;">
                                <?php else: ?>
                                    <p>ID Selfie not available</p>
                                <?php endif; ?>
                            </div>
                            <h6 class="card-title mt-2 mb-0" style="color: #0037ab">
                                <?php echo strtoupper($official['firstname'] . ' ' . $official['middlename'] . ' ' . $official['lastname']); ?>
                            </h6>
                            <strong><?php
                            switch ($official['position']) {
                                case 'skchairman':
                                    echo 'SK Chairman';
                                    break;
                                case 'skcouncilor':
                                    echo 'SK Councilor';
                                    break;
                                case 'sksecretary':
                                    echo 'SK Secretary';
                                    break;
                                case 'sktreasurer':
                                    echo 'SK Treasurer';
                                    break;
                                default:
                                    echo '';
                            }
                            ?></strong>
                            <?php
                                break;
                            endif;
                            endforeach;

                            if (!$foundOfficial) {
                                echo "<p>No $position available</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

