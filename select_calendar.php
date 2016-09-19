<?php
require_once 'model/Database.class.php';
require_once 'functions/calendar_storage.php';
//require_once 'functions/users.functions.php';

session_start();

if(isset($_POST['action'])) {
    $action = $_POST['action'];
}

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}

if($action == "delete") {
    deleteCalendar($id);
}

include './view/header.php';
?>

<div class="container--card box">
    <!-- <?php //if (isset($_SESSION['user'])) : ?>
        <?php //$calendars = retrieveCalendars($_SESSION['user']); ?> -->
        <?php $calendars = retrieveCalendars(); ?>
        <?php while($calendar = array_shift($calendars)) : ?>

        <div class="cardSpinner">
            <div class="card--calendar box box__shadow cardShrinker">
                <div class="card--wrapper card--wrapper__details">
                    <h4   class="card--calendar__text card--header"><?php echo $calendar['title']; ?></h4>
                    <!-- <span class="card--calendar__text card--details">Last edited: <?php echo $calendar['lastEditedDate']; ?></span>
                    <span class="card--calendar__text card--details">by <?php echo $calendar['lastEditedBy']; ?></span> -->
                </div>

                <div class="card--wrapper card--wrapper__button">
                    <!-- <a class="button card--button buttonShare">SHARE</a> -->
                    <form method="post" action="index.php">
                        <input type="hidden" name="id" class="idHook" value=<?php echo $calendar['id']; ?> />
                        <input type="hidden" name="action" value="edit" />
                        <!-- <a class="button button--edit card--button buttonEdit">EDIT</a> -->
                        <input class="button button--edit card--button buttonEdit" type="submit" value="EDIT" />
                    </form>
                    <form method="post" action="select_calendar.php">
                        <input type="hidden" name="id" class="idHook" value=<?php echo $calendar['id']; ?> />
                        <input type="hidden" name="action" value="delete" />
                        <!-- <a class="button button--delete card--button">DELETE</a> -->
                        <input class="button button--edit card--button buttonDelete" type="submit" value="DELETE" />
                    </form>
                </div>
            </div>
        </div>

        <?php endwhile; ?>
    <!-- <?php //endif; ?> -->

    <!-- <div class="shadow-box shareShadowBox"></div>
    <div class="share-window shareWindow">
        <input type="hidden" name="calID" class="calID" />
        <?php $users = getAllUsers(); ?>
        <?php while($user = array_shift($users)) : ?>
            <?php if ($user['username'] != $_SESSION['user']) : ?>
                <a class="button userShareButton"><?php echo $user['username']; ?></a>
            <?php endif; ?>
        <?php endwhile; ?>
        <div class="button--close buttonClose">
            X
        </div>
    </div> -->

</div>

<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/cal.js"></script>
<script src="js/selectJS.js"></script>
<?php include './view/footer.php'; ?>
