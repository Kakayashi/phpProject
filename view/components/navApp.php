<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand " href="index2.php">BlogApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index2.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index2.php?category=sport&action=category">Sport</a></li>
                            <li><a class="dropdown-item" href="index2.php?category=news&action=category">News</a></li>
                            <li><a class="dropdown-item" href="index2.php?category=technology&action=category">Technology</a></li>
                            <li><a class="dropdown-item" href="index2.php?category=other&action=category">Other</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item d-flex">
                        <a class="nav-link" aria-current="page" href="index2.php?action=zaloguj">Zaloguj</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>