@include('components.header')
@include('components.menu_block')
<div class="cart_block w-100">
    <div class="bc_block m-auto w-100">
        <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
            <span class="blue_color c_t1_span1 me-1"><a href="/">Главная</a></span>
            <span class="blue_color"> —</span>
            <span class="blue_color c_t1_span3 ms-1 me-0"><a href="/cart">Корзина</a></span>
            <span class="pink_color c_t1_span2 align-items-end ms-1"> — Оформление заказа</span>
        </div>
    </div>
    <div class="contacts_text2 blue_color catalog_text2"><span>Оформление</span> заказа</div>
    <div class="cart_screen me-auto ms-auto position-relative cart_height">
        <svg width="600" height="462" viewBox="0 0 600 462" fill="none" xmlns="http://www.w3.org/2000/svg" class="cart_img position-absolute z-n1">
            <path d="M2.54534 2.69528C-0.712304 5.94821 -0.712304 6.97058 1.80074 21.7482C3.8484 33.9234 4.87224 36.3398 9.43295 39.0351C12.2252 40.801 14.366 40.894 45.5463 40.894H78.7743L80.7289 51.768C81.8458 57.8092 92.8288 115.247 105.115 179.376C117.401 243.505 128.291 300.199 129.221 305.311C136.574 344.067 144.3 382.916 145.137 384.961C145.696 386.355 147.557 388.4 149.233 389.422C152.211 391.281 153.607 391.281 342.365 391.281C531.122 391.281 532.518 391.281 535.497 389.422C539.406 387.005 540.151 384.775 541.919 371.484C543.874 357.079 543.874 357.171 540.709 354.012L538.01 351.316H363.121H188.231L185.718 337.561C184.322 330.033 183.205 323.62 183.205 323.155C183.205 322.783 264.74 322.505 364.517 322.505C542.291 322.505 545.828 322.505 548.714 320.646C550.296 319.716 552.064 318.043 552.623 317.114C553.181 316.185 554.391 308.471 555.508 300.106C557.276 286.351 570.028 217.853 592.273 103.629C596.647 81.1373 600.091 61.7127 599.998 60.4115C599.812 59.0174 598.509 57.3445 596.554 56.0433C593.576 53.9986 592.552 53.9057 576.543 53.9057C562.023 53.9057 559.138 54.1845 555.787 55.6715L322.291 58.8925V97.5675H548.714C542.105 132.606 509.715 272.781 509.436 273.897L508.97 276.034H341.434C249.289 276.034 173.898 275.755 173.898 275.477C173.898 274.547 135.271 75.0032 128.291 40.0575C122.892 12.547 121.403 6.69174 119.635 4.83292C114.981 -0.092926 116.656 0 58.9492 0H5.24454L2.54534 2.69528Z" fill="#00ADB5" fill-opacity="0.05"/>
            <path d="M254.326 402.131C248.866 403.618 243.529 406.716 239.869 410.495C228.265 422.516 228.389 441.166 240.179 452.938C244.274 456.966 248.68 459.506 254.45 460.993C264.503 463.596 275.423 460.498 282.994 452.938C294.783 441.166 294.907 422.516 283.304 410.495C275.982 402.874 264.192 399.528 254.326 402.131Z" fill="#00ADB5" fill-opacity="0.1"/>
            <path d="M421.851 402.131C416.39 403.618 411.054 406.716 407.393 410.495C395.789 422.516 395.914 441.166 407.703 452.938C415.273 460.498 426.194 463.596 436.246 460.993C442.017 459.506 446.423 456.966 450.518 452.938C462.308 441.166 462.432 422.516 450.828 410.495C443.506 402.874 431.717 399.528 421.851 402.131Z" fill="#00ADB5" fill-opacity="0.1"/>
        </svg>
        <div class="cart_screen_text bread">
            <span class="c_t1_span1 blue_color"><a href="/">Главная</a></span>
            <span class="blue_color">—</span>
            <span class="c_t1_span1 blue_color"><a href="/cart">Корзина</a></span>
            <span class="c_t1_span2 pink_color"> — Оформление заказа</span>
        </div>
        <span class="wallpaper_screen_elem1_text blue_color">Оформление заказа</span>
        <div class="reciever_block d-flex flex-row mt-5">
            <div class="reciever_block_e1 s3_b_blue bg_white me-2">
                <div class="reciever_block_header d-flex align-items-center justify-content-center bg_blue">
                    <span class="white_color">Сведения о получателе</span>
                </div>
                <div class="entity_block d-flex flex-row ms-auto me-auto">
                    <button class="entity_block1 text-center white_color bg_blue"><span class="entity_block_text">Физическое лицо</span><span class="display-none">Физ. лицо</span></button>
                    <button class="entity_block2 text-center blue_color bg_white"><span class="entity_block_text">Юридическое лицо</span><span class="display-none">Юр. лицо</span></button>
                </div>
                <div class="reciever_block_body d-flex flex-column">
                    <div class="reciever_block_body_span_font">
                        <div class="d-flex flex-column mb-3">
                            <div class="reciever_block_body_text1 d-flex justify-content-between">
                                <div><span class="reciever_block_text_bold blue_color">Фамилия</span><span class="pink_color"> *</span></div>
                                <div class="reciever_block_body_text1_italic"><span class="pink_color">*</span><span class="blue_color"> поля, обязательные к заполнению</span></div>
                            </div>
                            <input class="reciever_block_input s3_b_blue bg_white mt-1 blue_color" type="text" placeholder="Введите фамилию получателя">
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <div><span class="reciever_block_text_bold blue_color">Имя</span><span class="pink_color"> *</span></div>
                            <input class="reciever_block_input s3_b_blue bg_white mt-1 blue_color" type="text" placeholder="Введите имя получателя">
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <div><span class="reciever_block_text_bold blue_color">Отчество</span><span class="pink_color"> *</span></div>
                            <input class="reciever_block_input s3_b_blue bg_white mt-1 blue_color" type="text" placeholder="Введите отчество получателя">
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <div><span class="reciever_block_text_bold blue_color">Email</span><span class="pink_color"> *</span></div>
                            <input class="reciever_block_input s3_b_blue bg_white mt-1 blue_color" type="text" placeholder="Введите электронную почту получателя">
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <div><span class="reciever_block_text_bold blue_color">Телефон</span><span class="pink_color"> *</span></div>
                            <input class="reciever_block_input s3_b_blue bg_white mt-1 blue_color" type="text" placeholder="Введите номер телефона получателя">
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <div><span class="reciever_block_text_bold blue_color">Комментарий</span></div>
                            <div class="position-relative mt-1">
                                <textarea class="reciever_block_input_com s3_b_blue bg_white blue_color" type="text" required></textarea>
                                <label class="com_placeholder position-absolute" disabled>Введите комментарий к заказу</label>
                            </div>
                        </div>
                    </div>
                    <div class="check d-flex align-items-center mt-3 mb-2">
                        <input class="me-3 goods_input1" type="checkbox" id="check4">
                        <label for="check4"></label>
                        <div class="check_text"><span class="blue_color ms-2">согласен(-на) на обработку</span><span class="pink_color border_bottom_pink ms-1"><a href="#">персональных данных</a></span></div>
                    </div>
                </div>
                <div class="reciever_block_footer d-flex align-items-center flex-column justify-content-center w-100">
                    <button class="white_color text-center bg_pink mb-3">Оформить заказ</button>
                    <div class="reciever_block_footer_text blue_color">Наш менеджер свяжется с Вами в течение нескольких минут в рабочее время с <span class="pink_color border_bottom_pink">10:00</span> до <span class="pink_color border_bottom_pink">20:00</span> часов</div>
                </div>
            </div>
            <div class="reciever_block_e2_1 s3_b_blue bg_white">
                <div class="reciever_block_e2_header bg_blue white_color d-flex justify-content-center align-items-center"><span>Способ получения</span></div>
                <div class="reciever_block_e2_1_body d-flex flex-column justify-content-between">
                    <div class="choice_block1 d-flex ms-auto me-auto">
                        <button class="choice_elem1 bg_blue white_color w-50 text-center">Самовывоз</button>
                        <button class="choice_elem2 bg_white blue_color w-50 text-center">Доставка</button>
                    </div>
                    <div class="reciever_block_e2_body_block2 d-flex justify-content-between flex-column ms-auto me-auto">
                        <div><span class="blue_color body_block2_text1">Адрес:</span><span class="pink_color body_block2_text2"> г. Пермь, ул. Героев Хасана, 56, этаж 2</span></div>
                        <div><span class="blue_color body_block2_text1">Телефон:</span><span class="pink_color body_block2_text2"> +7 (992) 222-42-44</span></div>
                    </div>
                    <div class="reciever_block_e2_body_block3 background-tint_black d-flex justify-content-center align-items-center ms-auto me-auto s3_b_blue">
                        <div class="white_color">Показать на карте</div>
                    </div>
                </div>
                <div class="reciever_block_e2_footer_1 align-self-end d-flex align-items-center justify-content-center w-100">
                    <div><span class="blue_color">К оплате:</span><span class="pink_color"> 90 200 ₽</span></div>
                </div>
            </div>
            <div class="reciever_block_e2_2 s3_b_blue bg_white d-none">
                <div class="reciever_block_e2_header bg_blue white_color d-flex justify-content-center align-items-center"><span>Способ получения</span></div>
                <div class="reciever_block_e2_2_body d-flex flex-column">
                    <div class="choice_block2 d-flex ms-auto me-auto">
                        <button class="choice_elem1 bg_white blue_color w-50 text-center">Самовывоз</button>
                        <button class="choice_elem2 bg_blue white_color w-50 text-center">Доставка</button>
                    </div>
                    <div class="reciever_block_e2_2_body_block2 d-flex flex-column justify-content-between ms-auto me-auto">
                        <div class="reciever_block_e2_2_body_block2_e1 d-flex flex-column">
                            <div class="mb-1"><span>Город получателя</span></div>
                            <input type="text" placeholder="Введите город получателя" class="blue_color">
                        </div>
                        <div class="reciever_block_e2_2_body_block2_e2 d-flex flex-column">
                            <div class="mb-1"><span>Адрес доставки</span></div>
                            <input type="text" placeholder="Введите адрес получателя" class="blue_color">
                        </div>
                    </div>
                </div>
                <div class="reciever_block_e2_footer_2 align-self-end d-flex align-items-center justify-content-evenly flex-column w-100 position-relative">
                    <div class="reciever_block_e2_footer_2_text1"><span class="blue_color me-1">Доставка:</span><span class="pink_color">500 ₽</span></div>
                    <div class="reciever_block_e2_footer_border position-absolute"></div>
                    <div><span class="blue_color">К оплате:</span><span class="pink_color"> 90 200 ₽</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.footer')