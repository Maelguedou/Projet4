<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Collapse Bootstrap</title>

    <!-- CSS Bootstrap pur depuis CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Test</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuTest"
                aria-controls="menuTest"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuTest">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">A</a></li>
                <li class="nav-item"><a class="nav-link" href="#">B</a></li>
                <li class="nav-item"><a class="nav-link" href="#">C</a></li>
            </ul>
        </div>

    </div>
</nav>

<!-- JS Bootstrap pur depuis CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
