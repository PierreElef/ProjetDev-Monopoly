window.onload = function()
{
    var canvas = document.getElementById('mon_canvas');
        if(!canvas)
        {
            alert("Impossible de récupérer le canvas");
            return;
        }

    var context = canvas.getContext('2d');
        if(!context)
        {
            alert("Impossible de récupérer le context du canvas");
            return;
        }

    
    
// Centre Plateau (plateau entier: 579,579)
context.strokeRect(0, 0, 423, 423); 
var image = new Image();
    image.src = '../../images/board/logo.jpg';
    image.addEventListener('load', function() {
        context.drawImage(image, 0, 0, 423, 423, 78, 78, 423, 423);
    }); 

// Ligne Bas
//1 Case Départ
context.strokeRect(501, 501, 78, 78);
var image1 = new Image();
    image1.src = '../../images/board/1.jpg';
    image1.addEventListener('load', function() {
        context.drawImage(image1,  0, 0, 161, 161, 502, 501, 77, 77);
    });

//2
context.strokeRect(454, 501, 47, 78);
var image2 = new Image();
    image2.src = '../../images/board/2.jpg';
    image2.addEventListener('load', function() {
        context.drawImage(image2, 0, 0, 148, 200, 455, 518, 45, 60);
    });
context.strokeRect(454, 502, 47, 15);
context.fillStyle="#944828";
context.fillRect(455, 502, 46, 15);

//3
context.strokeRect(407, 501, 47, 78);
var image3 = new Image();
    image3.src = '../../images/board/3.jpg';
    image3.addEventListener('load', function() {
        context.drawImage(image3, 0, 0, 148, 215, 408, 502, 45, 76);
    });

//4
context.strokeRect(360, 501, 47, 78);
var image4 = new Image();
    image4.src = '../../images/board/4.jpg';
    image4.addEventListener('load', function() {
        context.drawImage(image4, 0, 0, 148, 200, 361, 518, 45, 60);
    });
context.strokeRect(360, 502, 47, 15);
context.fillStyle="#944828";
context.fillRect(361, 502, 46, 15);

//5
context.strokeRect(313, 501, 47, 78);
var image5 = new Image();
    image5.src = '../../images/board/5.jpg';
    image5.addEventListener('load', function() {
        context.drawImage(image5, 0, 0, 148, 215, 314, 502, 45, 76);
    });

//6
context.strokeRect(266, 501, 47, 78);
var image6 = new Image();
    image6.src = '../../images/board/6.jpg';
    image6.addEventListener('load', function() {
        context.drawImage(image6, 0, 0, 148, 215, 267, 502, 45, 76);
    });

//7
context.strokeRect(219, 501, 47, 78);
var image7 = new Image();
    image7.src = '../../images/board/7.jpg';
    image7.addEventListener('load', function() {
        context.drawImage(image7, 0, 0, 148, 200, 220, 518, 45, 60);
    });
context.strokeRect(219, 502, 47, 15);
context.fillStyle="#bae4fa";
context.fillRect(220, 502, 46, 15);

//8
context.strokeRect(172, 501, 47, 78);//8
var image8 = new Image();
    image8.src = '../../images/board/8.jpg';
    image8.addEventListener('load', function() {
        context.drawImage(image8, 0, 0, 148, 215, 173, 502, 45, 76);
    });

//9
context.strokeRect(125, 501, 47, 78);
var image9 = new Image();
    image9.src = '../../images/board/9.jpg';
    image9.addEventListener('load', function() {
        context.drawImage(image9, 0, 0, 148, 200, 126, 518, 45, 60);
    });
context.strokeRect(125, 502, 47, 15);
context.fillStyle="#bae4fa";
context.fillRect(126, 502, 46, 15);

//10
context.strokeRect(78, 501, 47, 78);
var image10 = new Image();
    image10.src = '../../images/board/10.jpg';
    image10.addEventListener('load', function() {
        context.drawImage(image10, 0, 0, 148, 200, 79, 518, 45, 60);
    });
context.strokeRect(78, 502, 47, 15);
context.fillStyle="#bae4fa";
context.fillRect(79, 502, 46, 15);

//11
context.strokeRect(0, 501, 78, 78); 
var image11 = new Image();
    image11.src = '../../images/board/11.jpg';
    image11.addEventListener('load', function() {
        context.drawImage(image11, 0, 0, 161, 161, 1, 501, 77, 77);
    });

//Ligne gauche
//12
context.strokeRect(0, 454, 78, 47);
var image12 = new Image();
    image12.src = '../../images/board/12.jpg';
    image12.addEventListener('load', function() {
        context.drawImage(image12, 0, 0, 215, 148, 1, 455, 65, 45);
    });
context.strokeRect(62, 455, 15, 45);
context.fillStyle="#d82e87";
context.fillRect(62, 455, 15, 45);

//13
context.strokeRect(0, 407, 78, 47);
var image13 = new Image();
    image13.src = '../../images/board/13.jpg';
    image13.addEventListener('load', function() {
        context.drawImage(image13, 0, 0, 215, 148, 1, 408, 76, 45);
    });

//14
context.strokeRect(0, 360, 78, 47);
var image14 = new Image();
    image14.src = '../../images/board/14.jpg';
    image14.addEventListener('load', function() {
        context.drawImage(image14, 0, 0, 215, 148, 1, 361, 65, 45);
    });
context.strokeRect(62, 361, 15, 46);
context.fillStyle="#d82e87";
context.fillRect(62, 361, 15, 46);

//15
context.strokeRect(0, 313, 78, 47);
var image15 = new Image();
    image15.src = '../../images/board/15.jpg';
    image15.addEventListener('load', function() {
        context.drawImage(image15, 0, 0, 215, 148, 1, 314, 65, 45);
    });
context.strokeRect(62, 314, 15, 46);
context.fillStyle="#d82e87";
context.fillRect(62, 314, 15, 46);

//16
context.strokeRect(0, 266, 78, 47);
var image16 = new Image();
    image16.src = '../../images/board/16.jpg';
    image16.addEventListener('load', function() {
        context.drawImage(image16, 0, 0, 215, 148, 1, 267, 76, 45);
    });

//17
context.strokeRect(0, 219, 78, 47);
var image17 = new Image();
    image17.src = '../../images/board/17.jpg';
    image17.addEventListener('load', function() {
        context.drawImage(image17, 0, 0, 215, 148, 1, 220, 65, 45);
    });
context.strokeRect(62, 220, 15, 46);
context.fillStyle="#f49100";
context.fillRect(62, 220, 15, 46);

//18
context.strokeRect(0, 172, 78, 47);
var image18 = new Image();
    image18.src = '../../images/board/18.jpg';
    image18.addEventListener('load', function() {
        context.drawImage(image18, 0, 0, 215, 148, 1, 173, 76, 45);
    });

//19
context.strokeRect(0, 125, 78, 47);
var image19 = new Image();
    image19.src = '../../images/board/19.jpg';
    image19.addEventListener('load', function() {
        context.drawImage(image19, 0, 0, 215, 148, 1, 126, 65, 45);
    });
context.strokeRect(62, 126, 15, 46);
context.fillStyle="#f49100";
context.fillRect(62, 126, 15, 46);

//20
context.strokeRect(0, 78, 78, 47);
var image20 = new Image();
    image20.src = '../../images/board/20.jpg';
    image20.addEventListener('load', function() {
        context.drawImage(image20, 0, 0, 215, 148, 1, 79, 65, 45);
    });
context.strokeRect(62, 79, 15, 46);
context.fillStyle="#f49100";
context.fillRect(62, 79, 15, 46);

//Ligne Haut
//21
context.strokeRect(0, 0, 78, 78); 
    var image21 = new Image();
    image21.src = '../../images/board/21.jpg';
    image21.addEventListener('load', function() {
        context.drawImage(image21, 0, 0, 161, 161, 1, 1, 77, 77);
    });

//22
context.strokeRect(78, 0, 47, 78);
var image22 = new Image();
    image22.src = '../../images/board/22.jpg';
    image22.addEventListener('load', function() {
        context.drawImage(image22, 0, 0, 148, 200, 79, 1, 45, 62);
    });
context.strokeRect(78, 63, 47, 15);
context.fillStyle="#e30011";
context.fillRect(79, 64, 46, 13);

//23
context.strokeRect(125, 0, 47, 78);
var image23 = new Image();
    image23.src = '../../images/board/23.jpg';
    image23.addEventListener('load', function() {
        context.drawImage(image23, 0, 0, 148, 215, 126, 1, 45, 76);
    });

//24
context.strokeRect(172, 0, 47, 78);
var image24 = new Image();
    image24.src = '../../images/board/24.jpg';
    image24.addEventListener('load', function() {
        context.drawImage(image24, 0, 0, 148, 200, 173, 1, 45, 62);
    });
context.strokeRect(172, 63, 47, 15);
context.fillStyle="#e30011";
context.fillRect(173, 64, 46, 13);

//25
context.strokeRect(219, 0, 47, 78);
var image25 = new Image();
    image25.src = '../../images/board/25.jpg';
    image25.addEventListener('load', function() {
        context.drawImage(image25, 0, 0, 148, 200, 220, 1, 45, 62);
    });
context.strokeRect(219, 63, 47, 15);
context.fillStyle="#e30011";
context.fillRect(220, 64, 46, 13);

//26
context.strokeRect(266, 0, 47, 78);
var image26 = new Image();
    image26.src = '../../images/board/26.jpg';
    image26.addEventListener('load', function() {
        context.drawImage(image26, 0, 0, 148, 215, 267, 1, 45, 76);
    });

//27
context.strokeRect(313, 0, 47, 78);
var image27 = new Image();
    image27.src = '../../images/board/27.jpg';
    image27.addEventListener('load', function() {
        context.drawImage(image27, 0, 0, 148, 200, 314, 1, 45, 62);
    });
context.strokeRect(313, 63, 47, 15);
context.fillStyle="#fded03";
context.fillRect(314, 64, 46, 13);

//28
context.strokeRect(360, 0, 47, 78);
var image28 = new Image();
    image28.src = '../../images/board/28.jpg';
    image28.addEventListener('load', function() {
        context.drawImage(image28, 0, 0, 148, 200, 361, 1, 45, 62);
    });
context.strokeRect(360, 63, 47, 15);
context.fillStyle="#fded03";
context.fillRect(361, 64, 46, 13);

//29
context.strokeRect(407, 0, 47, 78);
var image29 = new Image();
    image29.src = '../../images/board/29.jpg';
    image29.addEventListener('load', function() {
        context.drawImage(image29, 0, 0, 148, 215, 408, 1, 45, 76);
    });

//30
context.strokeRect(454, 0, 47, 78);
var image30 = new Image();
    image30.src = '../../images/board/30.jpg';
    image30.addEventListener('load', function() {
        context.drawImage(image30, 0, 0, 148, 200, 455, 1, 45, 62);
    });
context.strokeRect(454, 63, 47, 15);
context.fillStyle="#fded03";
context.fillRect(455, 64, 46, 13);

//31
context.strokeRect(501, 0, 78, 78);
var image31 = new Image();
    image31.src = '../../images/board/31.jpg';
    image31.addEventListener('load', function() {
        context.drawImage(image31, 0, 0, 161, 161, 502, 1, 77, 76);
    });

//Ligne droite
//32
context.strokeRect(501, 78, 78, 47);
var image32 = new Image();
    image32.src = '../../images/board/32.jpg';
    image32.addEventListener('load', function() {
        context.drawImage(image32, 0, 0, 215, 148, 518, 79, 65, 45);
    });
context.strokeRect(502, 79, 15, 45);
context.fillStyle="#1ea54c";
context.fillRect(502, 79, 15, 45);

//33
context.strokeRect(501, 125, 78, 47);
var image33 = new Image();
    image33.src = '../../images/board/33.jpg';
    image33.addEventListener('load', function() {
        context.drawImage(image33, 0, 0, 215, 148, 518, 126, 65, 45);
    });
context.strokeRect(502, 126, 15, 45);
context.fillStyle="#1ea54c";
context.fillRect(502, 126, 15, 45);

//34
context.strokeRect(501, 172, 78, 47);
var image34 = new Image();
    image34.src = '../../images/board/34.jpg';
    image34.addEventListener('load', function() {
        context.drawImage(image34, 0, 0, 215, 148, 502, 173, 76, 45);
    });

//35
context.strokeRect(501, 219, 78, 47);
var image35 = new Image();
    image35.src = '../../images/board/35.jpg';
    image35.addEventListener('load', function() {
        context.drawImage(image35, 0, 0, 215, 148, 518, 220, 65, 45);
    });
context.strokeRect(502, 220, 15, 45);
context.fillStyle="#1ea54c";
context.fillRect(502, 220, 15, 45);

//36
context.strokeRect(501, 266, 78, 47);
var image36 = new Image();
    image36.src = '../../images/board/36.jpg';
    image36.addEventListener('load', function() {
        context.drawImage(image36, 0, 0, 215, 148, 502, 267, 76, 45);
    });

//37
context.strokeRect(501, 313, 78, 47);
var image37 = new Image();
    image37.src = '../../images/board/37.jpg';
    image37.addEventListener('load', function() {
        context.drawImage(image37, 0, 0, 215, 148, 502, 314, 76, 45);
    });

//38
context.strokeRect(501, 360, 78, 47);
var image38 = new Image();
    image38.src = '../../images/board/38.jpg';
    image38.addEventListener('load', function() {
        context.drawImage(image38, 0, 0, 215, 148, 518, 361, 65, 45);
    });
context.strokeRect(502, 361, 15, 45);
context.fillStyle="#0069b4";
context.fillRect(502, 361, 15, 45);

//39
context.strokeRect(501, 407, 78, 47);
var image39 = new Image();
    image39.src = '../../images/board/39.jpg';
    image39.addEventListener('load', function() {
        context.drawImage(image39, 0, 0, 215, 148, 502, 408, 76, 45);
    });

//40
context.strokeRect(501, 454, 78, 47);
var image40 = new Image();
    image40.src = '../../images/board/40.jpg';
    image40.addEventListener('load', function() {
        context.drawImage(image40, 0, 0, 215, 148, 518, 455, 65, 45);
    });
context.strokeRect(502, 455, 15, 45);
context.fillStyle="#0069b4";
context.fillRect(502, 455, 15, 45);
}