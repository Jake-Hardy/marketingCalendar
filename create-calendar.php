<?php include 'view/header.php'; ?>

    <div class="container closed">
        <!-- Class names that follow the BEM model (e.g., block--element__modifier)
             are used for CSS selectors, class names that use camelCase are JS
             hooks. Note: I have not done a very good job at sticking to this
             convention. -->
        <div class="calendar box__shadow clearfix">
            <div class="calendar--title box editable"><em class="calendar--title__text calendarTitle">Click to edit</em></div>
        </div>
    </div>

    <div class="container--messages"><span class="messages"></span></div>

    <div class="error"><?php echo $errors; ?></div>

    <div class="container--calendar-options__shadowbox"></div>
    <div class="container--calendar-options calendarOptions box">
        <div class="container--input__menu">
            <label>Number of Audiences</label>
            <input class="input__audience inputAudience" type="text" value="2" />
        </div>
        <div class="container--input__menu">
            <label>Number of Months</label>
            <br />
            <input class="input__months" type="radio"
                   name="months" value="3" checked>3<br />
            <input class="input__months" type="radio"
                   name="months" value="12">12<br />
       </div>
       <a class="button button--submit buttonSubmitOptions">Generate</a>
       <div class="button--close buttonClose">
           X
       </div>
    </div>

    <div class="container--form__login formLoginContainer box">
        <form class="formLogin" method="post" action=".">
            <label>Username</label>
            <input class="fieldUsername" type="text" name="username" />
            <input type="hidden" name="action" value="login" />
            <input type="hidden" name="prevAction" value=<?php echo $action; ?> />
            <a class="button button--submit buttonSubmitLogin">Submit</a>
            <p class="errorLogin"></p>
        </form>
        <span>Don't have an account yet? Click <a class="button" href="register.php">here</a> to register.</span>
        <div class="button--close buttonClose">
           X
        </div>
    </div>

    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/cal.js"></script>
</body>
</html>
