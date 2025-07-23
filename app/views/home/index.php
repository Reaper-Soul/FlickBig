<?php
    $viral_movies = $viral_movies ?? [];

    $celebrities = [
        [
            'name' => 'James Gunn',
            'image' => 'app/public/pics/james.webp',
        ],
        [
            'name' => 'Maggie Q',
            'image' => 'app/public/pics/maggie.jpg',
        ],
        [
            'name' => 'Emma Watson',
            'image' => 'app/public/pics/emma.jpg',
        ],
        [
            'name' => 'Brad Pitt',
            'image' => 'app/public/pics/brad.jpg',
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
                    <p class="view-all" style="color: var(--accent-color); cursor: pointer;"></p>
                </div>  
                <div class="movie-virals d-flex flex-row gap-2 mt-2 justify-content-between">
                      <?php foreach ($viral_movies as $movie): ?>
        <button class="bg-transparent border-0 open-movie-modal"
            data-title="<?= htmlspecialchars($movie['Title']) ?>"
            data-rating="<?= htmlspecialchars($movie['imdbRating']) ?>"
            data-year="<?= htmlspecialchars($movie['Year']) ?>"
            data-runtime="<?= htmlspecialchars($movie['Runtime']) ?>"
            data-director="<?= htmlspecialchars($movie['Director']) ?>"
            data-writers="<?= htmlspecialchars($movie['Writer']) ?>"
            data-plot="<?= htmlspecialchars($movie['Plot']) ?>"
            data-poster="<?= htmlspecialchars($movie['Poster']) ?>"
            data-genre="<?= htmlspecialchars($movie['Genre']) ?>"
            data-viewerrating="<?= $movie['viewerRating'] ?? 0 ?>"
            data-cast="<?= htmlspecialchars($movie['Actors']) ?>"
            data-imdbid="<?= htmlspecialchars($movie['imdbID']) ?>"
            data-flickScore="<?= htmlspecialchars($movie['flickScore'] ?? '')?>"
            data-reviews="<?= htmlspecialchars($movie['Reviews'] ?? '') ?>"
            data-bs-toggle="modal"
            data-bs-target="#movieModal"
          >
                            <?php include 'app/views/templates/components/movie_card.php'; ?>
                        </button>
                      <?php endforeach; ?>
                </div>
                <div class="row-2 d-flex flex-row gap-5 mt-5">
                    <div class="section-1 d-flex flex-column align-items-center">           
                        <div class="d-flex flex-row align-items-center justify-content-between gap-3 w-100">
                            <h4 class="fw-bold">Celebrity Spotlight</h4>
                            <p class="view-all" style="color: var(--accent-color); cursor: pointer;"></p>
                        </div>
                        <div class="celebrities d-flex flex-row gap-3 mt-2 justify-content-between align-items-start w-100 px-5">
                        <?php foreach ($celebrities as $celeb): ?>
                            <?php include 'app/views/templates/components/celeb_card.php'; ?>
                        <?php endforeach;?>
                        </div>
                    </div>
                    
                    <div class="section-2 d-flex flex-column align-items-center">
                        <div class="d-flex flex-row align-items-center justify-content-between gap-3 w-100">
                            <h4 class="fw-bold">Upcoming</h4>
                            <p class="view-all" style="color: var(--accent-color); cursor: pointer;"></p>
                        </div>
                        <div class="upcoming d-flex flex-column gap-3 mt-2 justify-content-between align-items-center w-100 px-0">                        <?php foreach ($upcoming_movies as $movie): ?>
        <button class="bg-transparent border-0 open-movie-modal w-100 text-start"
            data-title="<?= htmlspecialchars($movie['Title']) ?>"
            data-rating="<?= htmlspecialchars($movie['imdbRating']) ?>"
            data-year="<?= htmlspecialchars($movie['Year']) ?>"
            data-runtime="<?= htmlspecialchars($movie['Runtime']) ?>"
            data-director="<?= htmlspecialchars($movie['Director']) ?>"
            data-writers="<?= htmlspecialchars($movie['Writer']) ?>"
            data-plot="<?= htmlspecialchars($movie['Plot']) ?>"
            data-poster="<?= htmlspecialchars($movie['Poster']) ?>"
            data-genre="<?= htmlspecialchars($movie['Genre']) ?>"
            data-viewerrating="<?= $movie['viewerRating'] ?? 0 ?>"
            data-cast="<?= htmlspecialchars($movie['Actors']) ?>"
            data-imdbid="<?= htmlspecialchars($movie['imdbID']) ?>"
            data-flickScore="<?= htmlspecialchars($movie['flickScore'] ?? '')?>"
            data-reviews="<?= htmlspecialchars($movie['Reviews'] ?? '') ?>"
            data-bs-toggle="modal"
            data-bs-target="#movieModal"
          >
                            <?php include 'app/views/templates/components/upcoming_card.php'; ?>
        </button>
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'app/views/templates/footer.php' ?>

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