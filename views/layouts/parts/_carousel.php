<!-- Карусель -->
<div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">

    <!-- Слайды карусели -->
    <div class="carousel-inner">
        <!-- Слайды создаются с помощью контейнера с классом item, внутри которого помещается содержимое слайда -->
        <div class="active item">
            <img src="/images/slider-photo.jpg">
        </div>
        <!-- Слайд №2 -->
        <div class="item" >
            <img src="/images/slider-photo.jpg">
        </div>

    </div>
    <!-- Навигация для карусели -->
    <!-- Кнопка, осуществляющая переход на предыдущий слайд с помощью атрибута data-slide="prev" -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <!-- Кнопка, осуществляющая переход на следующий слайд с помощью атрибута data-slide="next" -->
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>