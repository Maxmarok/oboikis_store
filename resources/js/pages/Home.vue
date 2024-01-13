<script setup>
import Header from '@js/components/Header.vue'
import Footer from '@js/components/Footer.vue'
import Carousel from '@js/components/Carousel.vue'

const itemsPopular = [
    {
        id: 1, 
        title: 'Обои Euro Decor 7127-00', 
        type: 'wallpapper',
        promo: 'sale',
        description: 'Россия, 10.05 x 1.06 м Флизелин, Винил', 
        old_price: 17200, 
        price: 7200, 
        discount: 80,
        stock: 11,
        src: '/img/image_4.png',
    },

    {
        id: 2, 
        title: 'Обои Euro Decor 7127-00', 
        type: 'wallpapper',
        promo: 'sale',
        description: 'Россия, 10.05 x 1.06 м Флизелин, Винил', 
        old_price: 17200, 
        price: 7200, 
        discount: 80,
        stock: 11,
        src: '/img/image_4.png',
    },

    {
        id: 3, 
        title: 'Обои Euro Decor 7127-00', 
        type: 'wallpapper',
        promo: 'sale',
        description: 'Россия, 10.05 x 1.06 м Флизелин, Винил', 
        old_price: 17200, 
        price: 7200, 
        discount: 80,
        stock: 11,
        src: '/img/image_4.png',
    },

    {
        id: 4, 
        title: 'Обои Euro Decor 7127-00', 
        type: 'wallpapper',
        promo: 'sale',
        description: 'Россия, 10.05 x 1.06 м Флизелин, Винил', 
        old_price: 17200, 
        price: 7200, 
        discount: 80,
        stock: 11,
        src: '/img/image_4.png',
    },

    {
        id: 5, 
        title: 'Обои Euro Decor 7127-00', 
        type: 'wallpapper',
        promo: 'sale',
        description: 'Россия, 10.05 x 1.06 м Флизелин, Винил', 
        old_price: 17200, 
        price: 7200, 
        discount: 80,
        stock: 11,
        src: '/img/image_4.png',
    },

    {
        id: 6, 
        title: 'Обои Euro Decor 7127-00', 
        type: 'wallpapper',
        promo: 'sale',
        description: 'Россия, 10.05 x 1.06 м Флизелин, Винил', 
        old_price: 17200, 
        price: 7200, 
        discount: 80,
        stock: 11,
        src: '/img/image_4.png',
    },
];

const breakpoints = {
    1000: {
        itemsToShow: 1,
    },

    1400: {
        itemsToShow: 4,
        snapAlign: 'left',
    },
}

const feedbacks = [
    {
        id: 1,
        date: '24 мая 2023',
        author: 'Екатерина Югова',
        src: '/img/image 8-2.png',
        description: 'Широкий ассортимент и отличное обслуживание!',
    },

    {
        id: 2,
        date: '14 августа 2023',
        author: 'Елизавета Черткова',
        src: '/img/image 8-2.png',
        description: 'Тот момент, когда хочется оставить отзыв... Выбор обоев - сложный, муторный и долгий процесс...',
    },

    {
        id: 3,
        date: '26 июля 2023',
        author: 'Виктор Клименков',
        src: '/img/image 8-2.png',
        description: 'Магазин шикарен, полностью клиентоориентированный персонал, знают свое дело и являются лучшими...',
    },
]
</script>
<template>
<Header/>

<div class="block2 w-auto position-relative">
    <div class="block2_bg position-absolute top-0 left-0"></div>
    <div class="screen2 d-flex m-auto flex-column justify-content-evenly align-items-center position-relative">
        <div class="desc d-flex flex-column">
            <div class="screen2_text d-flex flex-row justify-content-evenly text-uppercase"><b><span class="pink_color">Обойкис</span> — идеальное место для</b></div>
            <div class="screen2_text d-flex flex-row justify-content-evenly text-uppercase"><b><span class="blue_color">оформления </span>уюта вашего <span class="yellow_color">дома</span></b></div>
        </div> 
        <div class="desc_adaptive d-flex flex-column">
            <div class="screen2_text d-flex flex-row justify-content-evenly text-uppercase white_color"><b><span class="pink_color">Обойкис</span> — идеальное</b></div>
            <div class="screen2_text d-flex flex-row justify-content-evenly text-uppercase white_color"><b>место для <span class="blue_color">оформления</span></b></div>
            <div class="screen2_text d-flex flex-row justify-content-evenly text-uppercase white_color"><b>уюта вашего <span class="yellow_color">дома</span></b></div>
            <button class="d-flex justify-content-center align-items-center white_color">Каталог товаров</button>
        </div> 

        <div class="screen2_blocks d-flex flex-row justify-content-between">
            <router-link to="/catalog/wallpapers">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center">
                    <div><img src="svg/wallpaper1.svg" class="me-2"><span class="blue_color">Обои</span></div>
                    <div class="blue_color">Перейти в каталог</div>
                </div>
            </router-link>
            <router-link to="/catalog/photo">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center">
                    <div><img src="svg/wallpaper2.svg" class="me-2"><span class="blue_color">Фотообои</span></div>
                    <div class="blue_color">Перейти в каталог</div>
                </div>
            </router-link>
            <router-link to="/catalog/fresk">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center">
                    <div><img src="svg/wallpaper3.svg" class="me-2"><span class="blue_color">Фрески</span></div>
                    <div class="blue_color">Перейти в каталог</div>
                </div>
            </router-link>
            <router-link to="/catalog/dekor">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center">
                    <div class="d-flex flex-row align-items-center justify-content-center"><img src="svg/wallpaper4.svg" class="me-2"><span class="blue_color d-flex flex-column justify-content-center">Лепной<br>декор</span></div>
                    <div class="blue_color">Перейти в каталог</div>
                </div>
            </router-link>
            <router-link to="/catalog/glue">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center">
                    <div><img src="svg/bucket.svg" class="me-2"><span class="blue_color">Клей</span></div>
                    <div class="blue_color">Перейти в каталог</div>
                </div>
            </router-link>
        </div>
    </div>
</div>
        
<div class="block3 w-auto mg_s3 border_top">
    <div class="screen3 d-flex m-auto flex-column align-items-center">
        <div class="screen3_text screen3_text_bg_blue">
            <span class="blue_color">Популярные товары</span>
        </div>
        
        <div class="screen3_blocks d-flex align-items-center justify-content-between flex-row position-relative">
            <Carousel 
                :items="itemsPopular"
                :breakpoints="breakpoints"
            />
        </div>
    </div>
</div>
<div class="block3 w-auto mg_s3">
    <div class="screen3 d-flex m-auto flex-column align-items-center">
        <div class="screen3_text screen3_text_bg_pink"><span class="pink_color">Товары по акции</span></div>
        <div class="screen3_blocks d-flex align-items-center justify-content-between flex-row position-relative">
            <svg width="600" height="600" viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg" class="sale position-absolute">
                <path d="M255.456 288.521L251.184 324.375L273.424 320.005L255.885 288.438L255.456 288.521Z" fill="#FF449F"/>
                <path d="M600 299.995L525.823 239.49L559.809 150.003L465.308 134.687L450 40.1953L360.513 74.182L300 0.00463867L239.487 74.1832L150.008 40.1953L134.692 134.688L40.2 150.005L74.1785 239.491L0 299.995L74.1785 360.501L40.2 449.995L134.692 465.312L150.008 559.803L239.487 525.817L300 599.995L360.514 525.818L450 559.805L465.307 465.313L559.808 449.996L525.821 360.503L600 299.995ZM181.369 377.074C166.358 380.032 150.605 376.95 141.682 371.208C141.005 370.753 140.517 369.812 141.07 368.829L149.406 354.396C149.835 353.562 150.686 353.395 151.495 353.825C158.873 357.675 168.464 360.79 178.659 358.782C188.705 356.808 193.455 351.025 192.125 344.225C191.002 338.558 186.905 335.692 175.14 336.386L169.903 336.675C149.829 337.823 137.122 330.776 133.777 313.782C130.298 296.079 141.294 281.703 162.113 277.615C174.852 275.103 187.5 276.599 196.793 281.234C197.76 281.638 198.007 282.166 197.495 283.298L191.382 297.888C190.961 298.706 190.275 298.987 189.498 298.698C181.179 295.336 173.595 294.179 165.673 295.74C157.172 297.409 153.653 302.664 154.85 308.751C155.932 314.27 160.583 317.038 171.952 316.418L177.18 316.13C197.528 314.923 209.796 321.92 213.224 339.335C216.645 356.75 206.292 372.175 181.369 377.074ZM311.93 349.787L293.523 353.414C292.532 353.604 291.879 353.298 291.4 352.348L282.568 336.593L248.862 343.219L246.789 361.12C246.707 362.177 246.226 362.707 245.236 362.905L226.69 366.547C225.698 366.746 225.302 366.233 225.417 365.325L240.172 265.355C240.288 264.438 240.742 263.769 241.733 263.578L259.577 260.067C260.569 259.869 261.246 260.324 261.701 261.124L312.64 348.173C313.086 348.969 312.921 349.596 311.93 349.787ZM391.105 334.214L328.377 346.556C327.526 346.721 326.849 346.259 326.675 345.417L308.293 251.965C308.128 251.105 308.591 250.428 309.442 250.263L327.427 246.728C328.277 246.553 328.947 247.009 329.112 247.867L343.957 323.343C344.073 323.904 344.412 324.135 344.973 324.028L387.452 315.675C388.311 315.502 388.989 315.948 389.154 316.799L392.243 332.521C392.411 333.371 391.964 334.049 391.105 334.214ZM468.026 319.096L406.281 331.232C405.43 331.405 404.753 330.942 404.587 330.091L386.215 236.64C386.041 235.78 386.496 235.112 387.347 234.939L449.091 222.803C449.933 222.629 450.611 223.084 450.784 223.943L453.758 239.086C453.923 239.937 453.469 240.614 452.626 240.779L411.13 248.943C410.568 249.057 410.338 249.388 410.445 249.967L414.203 269.082C414.319 269.645 414.666 269.876 415.227 269.76L449.776 262.97C450.619 262.803 451.304 263.259 451.47 264.102L454.418 279.112C454.591 279.963 454.129 280.641 453.286 280.806L418.73 287.596C418.167 287.712 417.936 288.05 418.052 288.612L421.977 308.587C422.085 309.149 422.432 309.371 422.993 309.257L464.489 301.103C465.332 300.929 466.008 301.392 466.181 302.243L469.155 317.394C469.323 318.245 468.868 318.922 468.026 319.096Z" fill="#FF449F"/>
            </svg>
            <div class="prevButton2_m d-none">
                <svg width="21" height="89" viewBox="0 0 21 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="21" height="89" rx="5" fill="#FF449F" fill-opacity="0.1"/>
                    <path d="M5.99999 7L14.9653 45.1484L5.99999 83.1485" stroke="white" stroke-width="5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="prevButton2">
                <svg class="nextButton_img" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="nextButton_color" cx="20" cy="20" r="20" fill="#bfbfbf" fill-opacity="1"/>
                    <mask id="path-2-inside-1_135_8378" fill="white">
                        <path d="M13 19.8994L22.8995 9.99992L32.799 19.8994L22.8995 29.7989L13 19.8994Z"/>
                    </mask>
                    <path d="M13 19.8994L11.5858 18.4852L10.1716 19.8994L11.5858 21.3136L13 19.8994ZM14.4142 21.3136L24.3137 11.4141L21.4853 8.58571L11.5858 18.4852L14.4142 21.3136ZM24.3137 28.3847L14.4142 18.4852L11.5858 21.3136L21.4853 31.2131L24.3137 28.3847Z" fill="white" mask="url(#path-2-inside-1_135_8378)"/>
                </svg>
            </div>
            <div class="screen3_cards d-flex align-items-center justify-content-between owl-carousel slider2 owl-theme">
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_pink">
                    <div class="discount d-flex justify-content-center align-items-center bg_pink"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 4.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 pink_color bg_pink2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center pink_color"><span class="text-center w-100">Обои Euro Decor <br>7127-00</span></div>
                    <div class="s3_b_footer_pink d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex pink_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/pinkcart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_pink">
                    <div class="discount d-flex justify-content-center align-items-center bg_pink"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 4.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 pink_color bg_pink2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center pink_color"><span class="text-center w-100">Обои Milassa Ok6 001</span></div>
                    <div class="s3_b_footer_pink d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex pink_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/pinkcart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_pink">
                    <div class="discount d-flex justify-content-center align-items-center bg_pink"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 4.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 pink_color bg_pink2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center pink_color"><span class="text-center w-100">Обои Milassa Ok6 001</span></div>
                    <div class="s3_b_footer_pink d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex pink_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/pinkcart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_pink">
                    <div class="discount d-flex justify-content-center align-items-center bg_pink"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 4.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 pink_color bg_pink2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center pink_color"><span class="text-center w-100">Обои Bernardo <br>Bartalucci 84123-1</span></div>
                    <div class="s3_b_footer_pink d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex pink_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/pinkcart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_pink">
                    <div class="discount d-flex justify-content-center align-items-center bg_pink"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 4.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 pink_color bg_pink2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center pink_color"><span class="text-center w-100">Обои Palitra Simple <br>SP72068-17</span></div>
                    <div class="s3_b_footer_pink d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex pink_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/pinkcart.svg">
                        </button>
                    </div>
                </div>
            </div>
            <div class="nextButton2">
                <svg class="nextButton_img" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="nextButton_color" cx="20" cy="20" r="20" fill="#bfbfbf" fill-opacity="1"/>
                    <mask id="path-2-inside-1_135_8378" fill="white">
                        <path d="M13 19.8994L22.8995 9.99992L32.799 19.8994L22.8995 29.7989L13 19.8994Z"/>
                    </mask>
                    <path d="M13 19.8994L11.5858 18.4852L10.1716 19.8994L11.5858 21.3136L13 19.8994ZM14.4142 21.3136L24.3137 11.4141L21.4853 8.58571L11.5858 18.4852L14.4142 21.3136ZM24.3137 28.3847L14.4142 18.4852L11.5858 21.3136L21.4853 31.2131L24.3137 28.3847Z" fill="white" mask="url(#path-2-inside-1_135_8378)"/>
                </svg>
            </div>
            <div class="nextButton2_m d-none">
                <svg width="21" height="89" viewBox="0 0 21 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="21" height="89" rx="5" fill="#FF449F" fill-opacity="0.1"/>
                    <path d="M5.99999 7L14.9653 45.1484L5.99999 83.1485" stroke="white" stroke-width="5" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>
</div>
<div class="block3 w-auto mg_s3">
    <div class="screen3 d-flex m-auto flex-column align-items-center">
        <div class="screen3_text screen3_text_bg_orange"><span class="orange_color">Горячая распродажа</span></div>
        <div class="screen3_blocks d-flex align-items-center justify-content-between flex-row position-relative">
            <svg width="443" height="562" viewBox="0 0 443 562" fill="none" xmlns="http://www.w3.org/2000/svg" class="fire position-absolute">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M192.912 19.5C228.575 133.613 423.463 166.744 423.463 319.237C423.463 456.056 347.787 543.206 192.219 542.325C54.1062 541.538 -63.6626 327.469 80.4125 188.25C95.4687 284.737 125.131 278.944 155.412 282C117.631 166.163 125.412 112.65 192.912 19.5Z" fill="#FF6B00"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M210.8 13.9124C208.7 7.14366 202.944 2.13735 195.931 0.993599C188.938 -0.150151 181.888 2.75613 177.725 8.49363C141.744 58.1436 122.169 97.4623 116.131 139.575C111.106 174.581 115.494 211.744 128.75 258.862C127.231 258.037 125.731 257.044 124.269 255.806C113.112 246.45 105.35 226.462 98.9375 185.362C97.85 178.444 93.0125 172.706 86.375 170.475C79.7375 168.244 72.425 169.894 67.3812 174.769C-26.9688 265.931 -11.6313 386.494 48.7624 468.562C89.2812 523.65 150.144 560.719 210.856 561.075C295.569 561.544 353.019 536.944 389.713 494.719C425.975 452.944 442.213 392.906 442.213 319.237C442.213 236.531 390.8 185.325 333.125 140.212C306.95 119.719 279.631 100.462 256.719 79.256C235.944 60.056 218.769 39.3562 210.8 13.9124ZM189.725 57.2249C216.294 100.762 264.294 133.969 310.006 169.744C358.7 207.825 404.713 249.431 404.713 319.237C404.713 382.387 392.487 434.325 361.4 470.119C330.725 505.444 281.919 523.969 211.063 523.575C161.3 523.294 112.194 491.494 78.9499 446.325C34.5124 385.912 18.5749 300.375 69.8374 228.919C78.2374 258.994 89.0563 275.212 100.138 284.512C116.431 298.2 134.675 298.762 153.538 300.656C159.838 301.294 166.044 298.706 170.019 293.756C173.994 288.825 175.212 282.206 173.244 276.187C155.487 221.737 147.931 182.025 153.256 144.9C157.4 115.894 169.456 88.6874 189.725 57.2249Z" fill="#FF6B00"/>
            </svg>
            <div class="prevButton3_m d-none">
                <svg width="21" height="89" viewBox="0 0 21 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="21" height="89" rx="5" fill="#FF6B00" fill-opacity="0.1"/>
                    <path d="M5.99999 7L14.9653 45.1484L5.99999 83.1485" stroke="white" stroke-width="5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="prevButton3">
                <svg class="nextButton_img" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="nextButton_color" cx="20" cy="20" r="20"  fill="#bfbfbf" fill-opacity="1"/>
                    <mask id="path-2-inside-1_135_8378" fill="white">
                        <path d="M13 19.8994L22.8995 9.99992L32.799 19.8994L22.8995 29.7989L13 19.8994Z"/>
                    </mask>
                    <path d="M13 19.8994L11.5858 18.4852L10.1716 19.8994L11.5858 21.3136L13 19.8994ZM14.4142 21.3136L24.3137 11.4141L21.4853 8.58571L11.5858 18.4852L14.4142 21.3136ZM24.3137 28.3847L14.4142 18.4852L11.5858 21.3136L21.4853 31.2131L24.3137 28.3847Z" fill="white" mask="url(#path-2-inside-1_135_8378)"/>
                </svg>
            </div>
            <div class="screen3_cards d-flex align-items-center justify-content-between owl-carousel slider3 owl-theme">
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_orange">
                    <div class="discount d-flex justify-content-center align-items-center bg_orange"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 5.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 orange_color bg_orange2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="orange_color d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center orange_color"><span class="text-center w-100">Обои Euro Decor <br>7127-00</span></div>
                    <div class="s3_b_footer_orange d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex orange_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/orangecart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_orange">
                    <div class="discount d-flex justify-content-center align-items-center bg_orange"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 5.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 orange_color bg_orange2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="orange_color d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center orange_color"><span class="text-center w-100">Обои Milassa Ok6 001</span></div>
                    <div class="s3_b_footer_orange d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex orange_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/orangecart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_orange">
                    <div class="discount d-flex justify-content-center align-items-center bg_orange"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 5.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 orange_color bg_orange2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="orange_color d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center orange_color"><span class="text-center w-100">Обои Milassa Ok6 001</span></div>
                    <div class="s3_b_footer_orange d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex orange_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/orangecart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_orange">
                    <div class="discount d-flex justify-content-center align-items-center bg_orange"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 5.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 orange_color bg_orange2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="orange_color d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center orange_color"><span class="text-center w-100">Обои Bernardo <br>Bartalucci 84123-1</span></div>
                    <div class="s3_b_footer_orange d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex orange_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/orangecart.svg">
                        </button>
                    </div>
                </div>
                <div class="screen3_block d-flex flex-column p-auto position-relative s3_b_orange">
                    <div class="discount d-flex justify-content-center align-items-center bg_orange"><span>-80%</span></div>
                    <div class="s3_b_img"><img src="img/image 5.png"></div>
                    <div class="s3_b1_text d-flex flex-row justify-content-around align-items-center w-100 orange_color bg_orange2">
                        <div class="s3_b_text0 d-flex align-items-center justify-content-center"><span>11 рулонов</span></div>
                        <div class="orange_color d-flex"><span class="s3_b_text1">Россия, 10.05 x 1.06 м <p class="text-end">Флизелин, Винил</p></span></div>
                    </div>
                    <div class="s3_b_text2 d-flex w-100 justify-content-center align-items-center orange_color"><span class="text-center w-100">Обои Palitra Simple <br>SP72068-17</span></div>
                    <div class="s3_b_footer_orange d-flex flex-row justify-content-around align-items-center">
                        <div>
                            <div class="d-flex flex-column">
                                <span class="s3_b_f_text1">17 200 ₽</span>
                                <span class="s3_b_f_text2">7 200 ₽</span>
                            </div>
                        </div>
                        <button class="d-flex orange_color flex-row align-items-center justify-content-evenly">
                            <span class="s3_b_footer_btn_text1">Купить</span>
                            <span class="s3_b_footer_btn_text2">В корзину</span>
                            <img src="svg/orangecart.svg">
                        </button>
                    </div>
                </div>
            </div>
            <div class="nextButton3">
                <svg class="nextButton_img" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="nextButton_color" cx="20" cy="20" r="20" fill="#bfbfbf" fill-opacity="1"/>
                    <mask id="path-2-inside-1_135_8378" fill="white">
                        <path d="M13 19.8994L22.8995 9.99992L32.799 19.8994L22.8995 29.7989L13 19.8994Z"/>
                    </mask>
                    <path d="M13 19.8994L11.5858 18.4852L10.1716 19.8994L11.5858 21.3136L13 19.8994ZM14.4142 21.3136L24.3137 11.4141L21.4853 8.58571L11.5858 18.4852L14.4142 21.3136ZM24.3137 28.3847L14.4142 18.4852L11.5858 21.3136L21.4853 31.2131L24.3137 28.3847Z" fill="white" mask="url(#path-2-inside-1_135_8378)"/>
                </svg>
            </div>
            <div class="nextButton3_m d-none">
                <svg width="21" height="89" viewBox="0 0 21 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="21" height="89" rx="5" fill="#FF6B00" fill-opacity="0.1"/>
                    <path d="M5.99999 7L14.9653 45.1484L5.99999 83.1485" stroke="white" stroke-width="5" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>
</div>
<div class="block4 w-auto bg_blue">
    <div class="screen4 m-auto d-flex flex-column align-items-center justify-content-evenly bg_blue">
        <div class="screen4_text d-flex justify-content-center align-items-center">
            <span>Отзывы о нас</span>
        </div>

        <div class="screen4_blocks d-flex flex-column w-100">
            <div class="d-flex flex-column m-auto flex-lg-row flex-wrap justify-content-center">
 
                <div class="screen4_element s3_b_pink" v-for="item in feedbacks">
                    <div class="s4_e_header d-flex flex-row justify-content-between">
                        <div class="s4_e_img">
                            <img :src="item.src">
                        </div>

                        <div class="s4_e_h_element d-flex flex-row justify-content-between">
                            <div class="d-flex flex-column justify-content-evenly s4_header_text">
                                <span class="s4_e_h_date d-flex align-items-end gray_color" v-html="item.date" />
                                <span class="s4_e_h_text d-flex align-items-start pink_color" v-html="item.author" />
                            </div>

                            <div class="d-flex justify-content-end align-items-start rate">
                                <span class="rate_number">5</span>
                                <img src="svg/star-svgrepo-com.svg" class="rate_star">
                                <img src="svg/star-svgrepo-com.svg" class="rate_star">
                                <img src="svg/star-svgrepo-com.svg" class="rate_star">
                                <img src="svg/star-svgrepo-com.svg" class="rate_star">
                                <img src="svg/star-svgrepo-com.svg">
                            </div>
                        </div>
                    </div>

                    <p class="blue_color ms-1 s4_text" v-html="item.description" />
                </div>
            </div>
        </div>
        <button class="d-flex justify-content-center align-items-center bg_pink"><span>Смотреть все</span></button>
    </div>
</div>
<div class="block5 w-auto">
    <div class="screen5 m-auto">
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afa9cda4220b075d88c43dd32dad1c4126c729c7d7f94ed1217de3e0e3afbf847&amp;source=constructor" frameborder="0"></iframe>
    </div>
</div>
<Footer/>
</template>