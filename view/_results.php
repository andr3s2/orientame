<nav class="navbar navbar-default navbar-fixed-top" style="margin-bottom: 400px">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="margin-top: -10px">
                <img alt="Brand" src="http://2.bp.blogspot.com/-58Yhlvz0cn0/VPi2Qbn6EPI/AAAAAAAAA_U/OwJdOM3Ge0A/s1600/brujula-1024x1024.png" width="40" height="40">
            </a>

        </div>

        <ul class="nav navbar-nav navbar-left">
            <li><a href="#">ORIENTACIÓN VOCACIONAL</a></li>
        </ul>
    </div>
</nav>
<br>
<br>

<div class="row-fluid" style="" id="profile" data-answers="<?php echo $user->answers ?>"
     data-token="<?php echo $user->token ?>"
>

    <div class="col-sm-10 col-sm-offset-1">

        <div class="col-sm-6"  style="text-align: center">

            <h3>Perfil</h3>

            <div class="row">
                <div class="well">
                <div class="col-xs-12" >
                    <a href="#" class="thumbnail" >
                        <img style="display: inline" src="<?php echo trim($user->url_image); ?> " width="300" height="300">
                    </a>
                </div>

                <p><strong>Nombre:</strong> <?php echo ucfirst($user->first_name) . " " . ucfirst($user->last_name) ?>
                </p>
                <p><strong>Email: </strong><?php echo strtolower($user->email) ?></p>
                </div>
            </div>
            <p>Eres excelente programador debieras trabajar en Google!!, Eres excelente programador debieras trabajar en Google!!
                Eres excelente programador debieras trabajar en Google!!
                Eres excelente programador debieras trabajar en Google!!
                Eres excelente programador debieras trabajar en Google!!</p>
        </div>

        <div class="col-sm-6" style="text-align: center">
            <div>
                <h3>Intereses</h3>
                <canvas id="interests" width="200" height="100" style="display: inline-block"></canvas>
            </div>
            <br>
            <div>
                <p>Tus intereses harán que llegues a la Luna!!, Tus intereses harán que llegues a la Luna!! Tus
                    intereses harán que llegues a la Luna!! Tus intereses harán que llegues a la Luna!! Tus intereses
                    harán que llegues a la Luna!!Tus intereses harán que llegues a la Luna!!
                    Tus intereses harán que llegues a la Luna!!
                    Tus intereses harán que llegues a la Luna!!
                    Tus intereses harán que llegues a la Luna!!
                    Tus intereses harán que llegues a la Luna!!</p>
            </div>
        </div>


    </div>
    <div class="col-sm-10 col-sm-offset-1">

        <div class="col-sm-6" style="text-align: center">
            <div>

                <h3>Personalidad</h3>

                <canvas id="personality" width="500" height="200" style="display: inline-block"></canvas>
            </div>

            <div>
                <p>Eres mas chistoso que Hassam, Eres mas chistoso que Hassam Eres mas chistoso que Hassam Eres mas
                    chistoso que Hassam Eres mas chistoso que Hassam Eres mas chistoso que Hassam Eres mas chistoso que
                    Hassam </p>
            </div>


        </div>
        <div class="col-sm-6" style="text-align: center">
            <div>
                <h3>Habilidades</h3>
                <canvas style="display: inline-block" id="skills" width="100" height="100"></canvas>
            </div>
            <div>
                <p>Tienes las habilidades de un Ninja Samurai, Tienes las habilidades de un Ninja Samurai Tienes las
                    habilidades de un Ninja Samurai Tienes las habilidades de un Ninja Samurai Tienes las habilidades de
                    un Ninja Samurai Tienes las habilidades de un Ninja Samurai Tienes las habilidades de un Ninja
                    Samurai,Tienes las habilidades de un Ninja Samurai,Tienes las habilidades de un Ninja Samurai</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="col-sm-12" style="margin-top: 20px; text-align: center">
        <div class="" style="display: inline-block">


            <a style="display: inline" href="#" class="btn btn-block btn-social btn-twitter"
               onclick="Orientame.socialNetwork.share('twitter')">
                <span class="fa fa-twitter"></span>
                Compartir en Twitter
            </a> &nbsp;
            <a href="#" style="display: inline" class="btn btn-block btn-social btn-facebook"
               onclick="Orientame.socialNetwork.share('facebook')">
                <span class="fa fa-facebook"></span>
                Compartir en Facebook
            </a>

        </div>
    </div>
</div>


<script src="https://code.createjs.com/createjs-2015.11.26.min.js"></script>
<script>

    var stage = new createjs.Stage("personality");

    var createRangePicker = function (y, e) {

        //add the circle
        var gradient = new createjs.Shape();
        gradient.graphics.beginFill("#B3B5C6").drawRoundRect(0, y, 500, 6, 3, 3);
        stage.addChild(gradient);

        //add the line
        var circle = new createjs.Shape();
        circle.graphics.beginFill("#000").drawCircle(e.position, y - 14, 8);
        circle.x = 0;
        circle.y = 17;
        stage.addChild(circle);

        //add the text
        var leftText = new createjs.Text(e.leftText, "16px Arial", "#ff7700");
        leftText.x = 0;
        leftText.y = y - 10;
        leftText.textBaseline = "alphabetic";
        stage.addChild(leftText);

        var rightText = new createjs.Text(e.righText, "16px Arial", "#ff7700");
        rightText.x = 400;
        rightText.y = y - 10;
        rightText.textBaseline = "alphabetic";
        stage.addChild(rightText);


        return circle;

    }

    function init() {

        var ranges = [
            {position: 200, leftText: 'Introvertido', righText: 'Extrovertido'},
            {position: 40, leftText: 'Sensitivo', righText: 'Intuitivo'},
            {position: 30, leftText: 'Pensativo', righText: 'Sentimental'},
            {position: 90, leftText: 'Juzgador', righText: 'Perceptor'},
        ];
        var pickers = [];

        _.each(ranges, function (e, i) {
            pickers[i] = createRangePicker((i + 1) * 40, ranges[i]);
        });

        stage.update();

        createjs.Ticker.on("tick", tick);

        function tick(event) {

            _.each(ranges, function (e, i) {
                if (pickers[i].x < ranges[i]) {
                    pickers[i].x += 1;
                }
            });
            stage.update(event); // important!!
        }
    }
    init();
</script>


<style>
    p   {
        font-size: 12px;
    }
</style>
