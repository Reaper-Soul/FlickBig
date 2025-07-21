<?php
    $viral_movies = $viral_movies ?? [];

    $celebrities = [
        [
            'name' => 'James Gunn',
            'image' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcR4T0978-rAKtLIJTM9nK4aFSP-mXLyGD_q1Axv0xZ8sB4nKmXD71lDLRIhve5EajBXucJ8EQCJtSn50BXw3K-3N2jVLXMy6t6Zcxeft0I7_A',
        ],
        [
            'name' => 'Maggie Q',
            'image' => 'https://www.hollywoodreporter.com/wp-content/uploads/2014/03/maggie_q_divergent_premiere_p.jpg',
        ],
        [
            'name' => 'Emma Watson',
            'image' => 'https://media.themoviedb.org/t/p/w500/A14lLCZYDhfYdBa0fFRpwMDiwRN.jpg',
        ],
        [
            'name' => 'Brad Pitt',
            'image' => 'https://m.media-amazon.com/images/M/MV5BMjA1MjE2MTQ2MV5BMl5BanBnXkFtZTcwMjE5MDY0Nw@@._V1_.jpg',
        ],
    ];

    $upcoming_movies = $upcoming_movies ?? [];
    if (isset($upcoming_movies)){
        usort($upcoming_movies, function($a, $b){
            $dateA = DateTime::createFromFormat('d M Y', $a['Released']);
            $dateB = DateTime::createFromFormat('d M Y', $b['Released']);

            if ($dateA === false || $dateB === false) {
                return 0; 
            }

            return $dateA<=>$dateB;
        });
    }
?>

<?php require_once 'app/views/templates/header.php' ?>
<div class="container" style="margin-top: 7rem; margin-bottom: 4rem;">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <h4 class="fw-bold">Viral Flicks</h4>
                    <p class="view-all" style="color: var(--accent-color); cursor: pointer;">Explore</p>
                </div>  
                <div class="movie-virals d-flex flex-row gap-2 mt-2 justify-content-between">
                      <?php foreach ($viral_movies as $movie): ?>
                        <?php include 'app/views/templates/movie_card.php'; ?>
                      <?php endforeach; ?>
                </div>
                <div class="row-2 d-flex flex-row gap-5 mt-5">
                    <div class="section-1 d-flex flex-column align-items-center">           
                        <div class="d-flex flex-row align-items-center justify-content-between gap-3 w-100">
                            <h4 class="fw-bold">Celebrity Spotlight</h4>
                            <p class="view-all" style="color: var(--accent-color); cursor: pointer;">See All</p>
                        </div>
                        <div class="celebrities d-flex flex-row gap-3 mt-2 justify-content-between align-items-start w-100 px-5">
                        <?php foreach ($celebrities as $celeb): ?>
                            <?php include 'app/views/templates/celeb_card.php'; ?>
                        <?php endforeach;?>
                        </div>
                    </div>
                    
                    <div class="section-2 d-flex flex-column align-items-center">
                        <div class="d-flex flex-row align-items-center justify-content-between gap-3 w-100">
                            <h4 class="fw-bold">Upcoming</h4>
                            <p class="view-all" style="color: var(--accent-color); cursor: pointer;">See All</p>
                        </div>
                        <div class="upcoming d-flex flex-column gap-3 mt-2 justify-content-between align-items-center w-100 px-0">                        <?php foreach ($upcoming_movies as $movie): ?>
                            <?php include 'app/views/templates/upcoming_card.php'; ?>
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    h4{
        color: var(--text-primary);
    }    
    p{
        margin: 0;
    }
    p.view-all{
        transition: color 0.3s ease;
    }
    p.view-all:hover{
        color: var(--accent-color-hover) !important;
    }
    .section-1{
        flex: 6;
    }
    .section-2{
        flex: 4;
    }
    .upcoming{
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        max-height: 400px;
        padding-bottom: 4em;
    }
</style>

<?php require_once 'app/views/templates/footer.php' ?>