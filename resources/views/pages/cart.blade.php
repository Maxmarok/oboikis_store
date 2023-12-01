
@include('components.header')

@include('components.menu_block')

<div class="cart_block w-100 position-relative">
<div class="bc_block m-auto w-100">
    <div class="breadcrumbs mb-5 ms-auto me-auto mt-5">
        <span class="blue_color c_t1_span1 me-1"><a href="#">Главная</a></span>
        <span class="pink_color">—</span>
        <span class="pink_color c_t1_span2 align-items-end">Корзина</span>
    </div>
</div>
<div class="contacts_text2 blue_color catalog_text2 m-0"><span class="pink_color">Корзина</span> товаров</div>
<div class="cart_screen me-auto ms-auto">
    <div class="cart_screen_text">
        <span class="c_t1_span1 blue_color" role="button"><a href="#">Главная</a></span>
        <span class="c_t1_span2 pink_color"> — Корзина</span>
    </div>
    <span class="wallpaper_screen_elem1_text blue_color">Корзина товаров</span>
    <div class="goods_block d-flex flex-row mt-5 position-relative">
        <img class="position-absolute goods_bg" src="svg/cart_bg.svg">
        <div class="goods_elem1 s3_b_blue me-2">
            <div class="goods_elem1_header">
                <div class="goods_elem1_header_elem1 d-flex align-items-center justify-content-center white_color bg_blue"><span>Выбранные товары</span></div>
                <div class="goods_elem1_header_elem2 d-flex align-items-center ps-4 bg_white">
                    <div class="me-4">
                        <input class="me-3 goods_input" type="checkbox" id="check">
                        <label for="check"></label>
                    </div>
                    <div class="h-100 d-flex align-items-center">
                        <div class="goods_elem1_header_elem2_text">
                            <span class="goods_elem1_header_elem2_t1 me-3 blue_color" role="button">Выбрать все для заказа</span>
                            <span class="goods_elem1_header_elem2_t2 pink_color" role="button">Удалить выбранное</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="goods_elem1_body">
                <div class="goods_elem1_body_block d-flex justify-content-between align-items-center ps-4 pe-4 change_bg1 bg_white">
                    <input class="me-3 goods_input1" type="checkbox" id="check1">
                    <label for="check1"></label>
                    <div class="position-relative">
                        <img class="goods_img s3_b_pink z-2 position-relative" src="img/image 4.png">
                        <img class="goods_sale position-absolute z-1" src="svg/sale.svg">
                        <div class="discount d-flex justify-content-center align-items-center bg_pink z-2"><span>-80%</span></div>
                    </div> 
                    <div class="goods_elem1_body_block_end d-flex flex-column justify-content-between">
                        <div class="goods_elem1_body_block_end_header d-flex justify-content-between">
                            <div class="d-flex flex-column align-items-start justify-content-between">
                                <span class="goods_elem1_header_text1 pink_color text_decoration_pink">Обои Bernardo Bartalucci 84123-1</span>
                                <span class="goods_elem1_header_text2 pink_color">Россия, 10.05 x 1.06 м Флизелин, Винил</span>
                            </div>
                            <div class="position-relative display-none">
                                <img class="goods_img s3_b_pink z-0" src="img/image 4.png">
                                <div class="goods_disc position-absolute bg_pink">-10%</div>
                            </div>
                            <div class="goods_elem1_body_block_end_div2 d-flex justify-content-center align-items-center flex-row"><span class="end_div2_text1 blue_color me-1">В наличии:</span><span class="end_div2_text2 pink_color"> 11 рулонов</span></div>
                        </div>
                        <div class="goods_elem1_body_block_end_footer d-flex w-100 justify-content-between">
                            <div class="goods_elem1_body_block_end_footer_b1 d-flex align-items-center">
                                <div class="d-flex justify-content-center q_block">
                                    <button class="q-minus pink_color" id="qm_1">-</button>
                                    <input class="quantity border-start-0 border-end-0 text-center pink_color" type="number" value="1" id="q_1">
                                    <button class="q-plus pink_color" id="qp_1">+</button>
                                </div>
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="display-none float-end">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.25 9.375C5.25 9.03 5.53 8.75 5.875 8.75C6.22 8.75 6.5 9.03 6.5 9.375V16.875C6.5 17.2206 6.22 17.5 5.875 17.5C5.53 17.5 5.25 17.2206 5.25 16.875V9.375ZM8.375 9.375C8.375 9.03 8.655 8.75 9 8.75C9.345 8.75 9.625 9.03 9.625 9.375V16.875C9.625 17.2206 9.345 17.5 9 17.5C8.655 17.5 8.375 17.2206 8.375 16.875V9.375ZM11.5 9.375C11.5 9.03 11.78 8.75 12.125 8.75C12.47 8.75 12.75 9.03 12.75 9.375V16.875C12.75 17.2206 12.47 17.5 12.125 17.5C11.78 17.5 11.5 17.2206 11.5 16.875V9.375ZM2.125 17.5C2.125 18.8806 3.24437 20 4.625 20H13.375C14.7556 20 15.875 18.8806 15.875 17.5V7.5H2.125V17.5ZM10.875 2.5H7.125V1.875C7.125 1.52938 7.405 1.25 7.75 1.25H10.25C10.595 1.25 10.875 1.52938 10.875 1.875V2.5ZM15.875 2.5H12.125V1.25C12.125 0.56 11.565 0 10.875 0H7.125C6.435 0 5.875 0.56 5.875 1.25V2.5H2.125C1.435 2.5 0.875 3.06 0.875 3.75V5C0.875 5.69 1.43437 6.24937 2.12437 6.25H15.8763C16.5656 6.24937 17.125 5.69 17.125 5V3.75C17.125 3.06 16.565 2.5 15.875 2.5Z" fill="#00ADB5"/>
                                </svg>
                                <div class="d-flex flex-column align-items-start ms-3 goods_elem1_footer_text">
                                    <span class="goods_elem1_footer_text2 ">7 200 ₽</span>
                                    <span class="goods_elem1_footer_text1 pink_color">4 400 ₽</span>
                                </div>
                            </div>
                            <span class="goods_elem1_header_elem2_t2 pink_color align-self-end" role="button">Удалить</span>
                            <div class="goods_elem1_body_block_end_footer_bottom_m display-none">
                                <div class="goods_elem1_body_block_end_footer_bottom_m_text1 bg_pink">70 200 ₽</div>
                                <div class="goods_elem1_body_block_end_footer_bottom_m_text2">140 200 ₽</div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="goods_elem1_body_block d-flex justify-content-between align-items-center ps-4 pe-4 change_bg2 bg_white">
                    <input class="me-3 goods_input2" type="checkbox" id="check2">
                    <label for="check2"></label>
                    <img class="goods_img s3_b_blue z-0" src="img/image 4.png">
                    <div class="goods_elem1_body_block_end d-flex flex-column justify-content-between">
                        <div class="goods_elem1_body_block_end_header d-flex justify-content-between">
                            <div class="d-flex flex-column align-items-start justify-content-between">
                                <span class="goods_elem1_header_text1 blue_color">Обои Bernardo Bartalucci 84123-1</span>
                                <span class="goods_elem1_header_text2 blue_color">Россия, 10.05 x 1.06 м Флизелин, Винил</span>
                            </div>
                            <img class="goods_img s3_b_blue z-0 display-none" src="img/image 4.png">
                            <div class="goods_elem1_body_block_end_div1 d-flex justify-content-center align-items-center gray_color2 bg_white border_gray">На заказ</div>
                        </div>
                        <div class="goods_elem1_body_block_end_footer d-flex w-100 justify-content-between">
                            <div class="goods_elem1_body_block_end_footer_b1 d-flex align-items-center">
                                <div class="d-flex justify-content-center q_block">
                                    <button class="q-minus blue_color" id="qm_1">-</button>
                                    <input class="quantity border-start-0 border-end-0 text-center blue_color" type="number" value="1" id="q_1">
                                    <button class="q-plus blue_color" id="qp_1">+</button>
                                </div>
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="display-none float-end">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.25 9.375C5.25 9.03 5.53 8.75 5.875 8.75C6.22 8.75 6.5 9.03 6.5 9.375V16.875C6.5 17.2206 6.22 17.5 5.875 17.5C5.53 17.5 5.25 17.2206 5.25 16.875V9.375ZM8.375 9.375C8.375 9.03 8.655 8.75 9 8.75C9.345 8.75 9.625 9.03 9.625 9.375V16.875C9.625 17.2206 9.345 17.5 9 17.5C8.655 17.5 8.375 17.2206 8.375 16.875V9.375ZM11.5 9.375C11.5 9.03 11.78 8.75 12.125 8.75C12.47 8.75 12.75 9.03 12.75 9.375V16.875C12.75 17.2206 12.47 17.5 12.125 17.5C11.78 17.5 11.5 17.2206 11.5 16.875V9.375ZM2.125 17.5C2.125 18.8806 3.24437 20 4.625 20H13.375C14.7556 20 15.875 18.8806 15.875 17.5V7.5H2.125V17.5ZM10.875 2.5H7.125V1.875C7.125 1.52938 7.405 1.25 7.75 1.25H10.25C10.595 1.25 10.875 1.52938 10.875 1.875V2.5ZM15.875 2.5H12.125V1.25C12.125 0.56 11.565 0 10.875 0H7.125C6.435 0 5.875 0.56 5.875 1.25V2.5H2.125C1.435 2.5 0.875 3.06 0.875 3.75V5C0.875 5.69 1.43437 6.24937 2.12437 6.25H15.8763C16.5656 6.24937 17.125 5.69 17.125 5V3.75C17.125 3.06 16.565 2.5 15.875 2.5Z" fill="#00ADB5"/>
                                </svg>
                                <span class="goods_elem1_footer_text1 ms-3 align-self-center blue_color">7 200 ₽</span>
                            </div>
                            <span class="goods_elem1_header_elem2_t2 pink_color align-self-end" role="button">Удалить</span>
                            <div class="goods_elem1_body_block_end_footer_bottom_m display-none">
                                <div class="goods_elem1_body_block_end_footer_bottom_m_text1 bg_blue">70 200 ₽</div>
                                <div class="goods_elem1_body_block_end_footer_bottom_m_text2 d-none">140 200 ₽</div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="goods_elem1_body_block d-flex justify-content-between align-items-center ps-4 pe-4 change_bg3 bg_white goods_elem1_body_block_last">
                    <input class="me-3 goods_input3" type="checkbox" id="check3">
                    <label for="check3"></label>
                    <div class="position-relative">
                        <img class="goods_img s3_b_orange z-2 position-relative" src="img/image 4.png">
                        <img class="goods_fire position-absolute z-1" src="svg/fire.svg">
                        <div class="discount d-flex justify-content-center align-items-center bg_orange z-3"><span>-10%</span></div>
                    </div> 
                    <div class="goods_elem1_body_block_end d-flex flex-column justify-content-between">
                        <div class="goods_elem1_body_block_end_header d-flex justify-content-between">
                            <div class="d-flex flex-column align-items-start justify-content-between">
                                <span class="goods_elem1_header_text1 orange_color text_decoration_orange">Обои Bernardo Bartalucci 84123-1</span>
                                <span class="goods_elem1_header_text2 orange_color">Россия, 10.05 x 1.06 м Флизелин, Винил</span>
                            </div>
                            <div class="position-relative display-none">
                                <img class="goods_img s3_b_orange z-0" src="img/image 4.png">
                                <div class="goods_disc position-absolute bg_orange">-10%</div>
                            </div>
                            <div class="goods_elem1_body_block_end_div2 d-flex justify-content-center align-items-center flex-row"><span class="end_div2_text1 blue_color me-1">В наличии:</span><span class="end_div2_text2 pink_color"> 11 рулонов</span></div>
                        </div>
                        <div class="goods_elem1_body_block_end_footer d-flex w-100 justify-content-between">
                            <div class="goods_elem1_body_block_end_footer_b1 d-flex align-items-center">
                                <div class="d-flex justify-content-center q_block">
                                    <button class="q-minus orange_color" id="qm_1">-</button>
                                    <input class="quantity border-start-0 border-end-0 text-center orange_color" type="number" value="1" id="q_1">
                                    <button class="q-plus orange_color" id="qp_1">+</button>
                                </div>
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="display-none float-end">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.25 9.375C5.25 9.03 5.53 8.75 5.875 8.75C6.22 8.75 6.5 9.03 6.5 9.375V16.875C6.5 17.2206 6.22 17.5 5.875 17.5C5.53 17.5 5.25 17.2206 5.25 16.875V9.375ZM8.375 9.375C8.375 9.03 8.655 8.75 9 8.75C9.345 8.75 9.625 9.03 9.625 9.375V16.875C9.625 17.2206 9.345 17.5 9 17.5C8.655 17.5 8.375 17.2206 8.375 16.875V9.375ZM11.5 9.375C11.5 9.03 11.78 8.75 12.125 8.75C12.47 8.75 12.75 9.03 12.75 9.375V16.875C12.75 17.2206 12.47 17.5 12.125 17.5C11.78 17.5 11.5 17.2206 11.5 16.875V9.375ZM2.125 17.5C2.125 18.8806 3.24437 20 4.625 20H13.375C14.7556 20 15.875 18.8806 15.875 17.5V7.5H2.125V17.5ZM10.875 2.5H7.125V1.875C7.125 1.52938 7.405 1.25 7.75 1.25H10.25C10.595 1.25 10.875 1.52938 10.875 1.875V2.5ZM15.875 2.5H12.125V1.25C12.125 0.56 11.565 0 10.875 0H7.125C6.435 0 5.875 0.56 5.875 1.25V2.5H2.125C1.435 2.5 0.875 3.06 0.875 3.75V5C0.875 5.69 1.43437 6.24937 2.12437 6.25H15.8763C16.5656 6.24937 17.125 5.69 17.125 5V3.75C17.125 3.06 16.565 2.5 15.875 2.5Z" fill="#00ADB5"/>
                                </svg>
                                <div class="d-flex flex-column align-items-start ms-3 goods_elem1_footer_text">
                                    <span class="goods_elem1_footer_text2 ">7 200 ₽</span>
                                    <span class="goods_elem1_footer_text1 orange_color">4 400 ₽</span>
                                </div>
                            </div>
                            <span class="goods_elem1_header_elem2_t2 pink_color align-self-end" role="button">Удалить</span>
                            <div class="goods_elem1_body_block_end_footer_bottom_m display-none">
                                <div class="goods_elem1_body_block_end_footer_bottom_m_text1 bg_orange">70 200 ₽</div>
                                <div class="goods_elem1_body_block_end_footer_bottom_m_text2">140 200 ₽</div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="goods_elem2 s3_b_blue bg_white">
            <div class="goods_elem2_body_border1 position-absolute"></div>
            <div class="goods_elem2_body_border2 position-absolute"></div>
            <div class="goods_elem2_header d-flex align-items-center justify-content-center white_color bg_blue"><span class="goods_elem2_header_text1">Стоимость</span><span class="goods_elem2_header_text2">Итоговая стоимость</span></div>
            <div class="goods_elem2_body d-flex justify-content-center align-items-center">
                <div class="goods_elem2_body_center d-flex flex-column align-items-center justify-content-between">
                    <div><span class="blue_color">Цена: 90 200 ₽</span></div>
                    <div class="goods_elem2_body_center_gray"><span class="gray_color2">Скидка: 0 ₽</span></div>
                    <div><span class="blue_color">Итого:</span><span class="pink_color"> 90 200 ₽</span></div>
                </div>
            </div>
            <div class="goods_elem2_footer d-flex align-items-center justify-content-center">
                <button class="white_color bg_pink"><span class="goods_elem2_footer_text1">Заказать выбранные товары</span><span class="goods_elem2_footer_text2">Оформить заказ</span></button>
            </div>
        </div>
    </div>
</div>
</div>

@include('components.footer')