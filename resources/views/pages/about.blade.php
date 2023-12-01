
@include('components.header')
@include('components.menu_block')
<div class="w-100 about_company_block position-relative">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <span class="blue_color c_t1_span1">Главная</span>
            <span class="pink_color c_t1_span2 align-items-end m-0"> — О компании</span>
        </div>
    </div>
    <div class="about_company_screen me-auto ms-auto position-relative">
        <div class="mb-5 bread">
            <span class="blue_color c_t1_span1">Главная </span>
            <span class="pink_color c_t1_span2 align-items-end">— О компании</span>
        </div>
        <img class="about_company_bg position-absolute" src="svg/about_company_bg.svg">
        <div class="about_company_text d-flex flex-column mb-5">
            <span class="about_company_text1 blue_color mb-5">О компании <span> «Обойкис»</span></span>
            <div class="about_company_text3 d-none flex-column justify-content-between">
                <div class="about_company_text3_block"><div>Качественные европейские обои <span class="pink_color">премиум</span> класса.</div></div>
                <div class="about_company_text3_block"><div><span class="pink_color">Огромный</span> ассортимент, разнообразия цветовых и фактурных решений.</div></div>
                <div class="about_company_text3_block"><div><span class="pink_color">Итальянские, немецкие</span> производители в наличии и под заказ.</div></div>
            </div>
            <div class="about_company_text2 d-flex flex-column justify-content-between blue_color">
                <div>Качественные европейские обои <span>премиум</span> класса.<br></div>
                <div><span>Огромный</span> ассортимент, разнообразия цветовых и фактурных решений.<br></div>
                <div><span>Итальянские, немецкие</span> производители в наличии и под заказ.</div>
            </div>
        </div>
        <div class="about_company_footer d-flex flex-column justify-content-evenly align-items-center">
            <span class="blue_color">Фотогалерея магазина</span>
            <div class="about_company_body d-flex justify-content-between flex-column">
                <div class="about_company_body_row d-flex justify-content-between">
                    <div class="about_company_body_elem"><a href="img/photogallery_img1.jpeg" data-fancybox="gallery"><img src="img/photogallery_img1.jpeg"></a></div>
                    <div class="about_company_body_elem"><a href="img/photogallery_img1.jpeg" data-fancybox="gallery"><img src="img/photogallery_img1.jpeg"></a></div>
                    <div class="about_company_body_elem"><a href="img/photogallery_img1.jpeg" data-fancybox="gallery"><img src="img/photogallery_img1.jpeg"></a></div>
                </div>
                <div class="about_company_body_row d-flex justify-content-between">
                    <div class="about_company_body_elem"><a href="img/photogallery_img1.jpeg" data-fancybox="gallery"><img src="img/photogallery_img1.jpeg"></a></div>
                    <div class="about_company_body_elem"><a href="img/photogallery_img1.jpeg" data-fancybox="gallery"><img src="img/photogallery_img1.jpeg"></a></div>
                    <div class="about_company_body_elem"><a href="img/photogallery_img1.jpeg" data-fancybox="gallery"><img src="img/photogallery_img1.jpeg"></a></div> 
                </div>
            </div>
            <button class="white_color bg_pink">Перейти к каталогу товаров</button>
        </div>
    </div>
</div>
@include('components.footer')