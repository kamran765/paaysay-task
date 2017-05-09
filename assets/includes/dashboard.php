<?php
    $userinfo = $auth->userinfo();
?>
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a hef="home.html">
                     <img src="assets/images/logo.png" alt="merkery_logo" class="hidden-xs hidden-sm">
                    <img src="assets/images/logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo" >
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li class="active"><a href="#"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <div class="search hidden-xs hidden-sm">
                                <h1>Google Task API</h1>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_task">Add Task</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $userinfo->picture?>" alt="user">
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="navbar-content">
                                                    <span><?php echo $userinfo->name; ?></span>
                                                    <p class="text-muted small">
                                                        <?php echo $userinfo->email; ?>
                                                    </p>
                                                    <div class="divider">
                                                    </div>
                                                    <a href="?logout" class="view btn-sm active">logout</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    <h1>ALL Tasks <small><a href="?clearall"  class="float-left" id="delete_all">Delete all tasks</a></small></h1>
                    <div class="row">
                        <div class="col-md-12 ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="width: 100%;">
                                      <th style="width: 95%;">Task</th>
                                      <th style="width: 5%;">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (count($auth->getTasks()['tasks']['modelData']) != 0): ?>
                                    <?php foreach ($auth->getTasks()['tasks']['modelData']['items'] as $task): ?>
                                        <tr>
                                            <td style="background-color: rgba(255,255,255,0.8);"><p style="font-size: 16px; font-weight: 300; color:#878787;"><?php echo $task['title']; ?></p></td>
                                            <td class="text-center"><a href="index.php?task=<?php echo $task['id']; ?>" alt="delete this task" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th>Task</th>
                                      <th>Operations</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div id="add_task" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Task</h4>
                </div>
                <form action="index.php" method="post" id="task_form">
                    <div class="modal-body">
                        <textarea form="task_form" name="task" class="form-control" placeholder="Enter your task" required></textarea><br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel" data-dismiss="modal">Close</button>
                        <!-- <input type="submit" value="Save" class="add-project"> -->
                        <button type="submit" form="task_form"  class="add-project" >Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>