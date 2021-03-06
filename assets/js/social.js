$(document).ready(function () {

    Orientame = Orientame || {};

    Orientame.socialNetwork = (function ($, _) {

        var answers = $("#profile").data('answers');
        var token = $("#profile").data('token');


        var share = function (network) {


            window.open("https://www.facebook.com/dialog/feed?" +
                "app_id="+$("#profile").data('app-id')+"&" +
                "amp;caption=Mis%Resultados&link="+Orientame.URL.profile+$("#profile").data('uid')+"&" +
                "redirect_uri="+ Orientame.URL.close,
                '',
                'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=500'
            );

            /*//get the canvas images
             var interests = document.getElementById('interests').toDataURL();
             var skills = document.getElementById('skills').toDataURL();
             var personality = document.getElementById('personality').toDataURL();
             var description = _convertDescriptionToCanvas();


             bootbox.prompt("Comenta algo sobre tu resultado", function (result) {
             if (result !== null) {


             $.ajax({
             url: 'api.php?action=share&type=' + network.toLowerCase(),
             type: 'POST',
             headers: {
             'token': '$4mr$8xy5vPxsn'
             },
             data: {
             interests: interests,
             skills: skills,
             personality: personality,
             description: description,
             token: token,
             message: result
             },
             beforeSend: function () {
             Orientame.UI.coverOn();
             }
             }).done(function (r) {
             location.href = 'sharer.php?action=share&code=' + r.code;
             }).fail(function (e) {
             $.notify({
             message: 'Ha ocurrido un error compartiendo el resultado, por favor inténtelo nuevamente'
             }, {
             type: 'danger',
             z_index: 1052
             });
             Orientame.UI.coverOff();
             })

             }
             });*/


        }

        var _convertDescriptionToCanvas = function () {
            //Convert the description to canvas
            var description = $("#user-description").text();
            var c = document.getElementById("canvas-user-description");
            var ctx = c.getContext("2d");

            ctx.font = "10px Georgia";
            wrapText(ctx, description, 20, 20, 400, 10);
            //_fillTextMultiLine(ctx, description, 10,0);
            // ctx.fillText(description, 10, 50);

            return document.getElementById('canvas-user-description').toDataURL();
        }


        function wrapText(context, text, x, y, maxWidth, lineHeight) {
            var cars = text.split("\n");

            for (var ii = 0; ii < cars.length; ii++) {

                var line = "";
                var words = cars[ii].trim().split(" ");

                for (var n = 0; n < words.length; n++) {
                    var testLine = line + words[n] + " ";
                    var metrics = context.measureText(testLine);
                    var testWidth = metrics.width;

                    if (testWidth > maxWidth) {
                        context.fillText(line, x, y);
                        line = words[n] + " ";
                        y += lineHeight;
                    }
                    else {
                        line = testLine;
                    }
                }

                context.fillText(line.trim(), x, y);
                y += lineHeight;
            }
        }

        return {
            share: share
        }


    })($, _);


    //Orientame.socialNetwork.render();

})
