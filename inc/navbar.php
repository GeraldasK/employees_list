<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="dashboard.php">EmloList</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#devices">Devices<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="action/logout.action.php" method="POST">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Logout</button>
        </form>
      </div>
    </nav>