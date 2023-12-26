<script setup>
import {ref} from 'vue'
const menuOpen = ref(false)

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value
}
</script>
<template>
    <nav class="w-auto bg_blue mobile_header_border">
        <div class="menu d-flex m-auto justify-content-between flex-row bg_blue vw-100">
            <div class="nav_element align-self-center position-relative" @click="toggleMenu">
                <div class="nav_element_line1" :class="{'nav_element_rotate1': menuOpen}"></div>
                <div class="nav_element_line2" :class="{'nav_element_rotate2': menuOpen}"></div>
            </div>
            <div class="menu_contacts d-flex flex-row align-items-center">
                <div class="contacts d-flex flex-column align-items-center me-4">
                    <div class="number d-flex pb-1"><a href="tel:+79922224244" class="text-decoration-none white_color">+7 (992) 222-42-44</a></div>
                    <div class="d-flex align-items-center"><a href="mailto:oboikis@yandex.ru" class="text-decoration-none white_color">oboikis<img src="svg/at.svg">yandex.ru</a></div>
                </div>
                <div class="city d-flex align-items-center justify-content-between"><img src="svg/house.svg" class="me-1">г. Пермь</div>
            </div> 
            <div class="d-flex align-items-center menu_logo"><router-link to="/"><img src="svg/logo.svg"></router-link></div>
            <div class="header_block3 d-flex justify-content-evenly align-items-center">
                <div class="search">
                    <form class="d-flex justify-content-center align-items-center" action="" method="GET">
                        <input name="s" placeholder="Поиск..." type="search" class="white_color">
                        <button type="submit"><img src="svg/glass.svg"></button>
                    </form>
                </div>
                <router-link to="/cart">
                    <div class="d-flex flex-row align-items-center">
                        <div class="counter d-flex align-items-center justify-content-center">0</div>
                        <div class="menu_cart_block">Корзина<img src="svg/cart.svg" class="ms-2"></div>
                    </div>
                </router-link>
            </div>
            <div class="menu2 vw-100 white_color justify-content-between position-absolute flex-column" :class="{'menu2_open': menuOpen}">
                <div class="menu2_block1 d-flex justify-content-around">
                    <div class="menu2_block1_element d-flex flex-column">
                        <div class="menu2_block1_element_text1 yellow_color">Главная</div>
                        <div class="menu2_block1_element_text2">Корзина</div>
                        <!-- <div class="menu2_block1_divider w-100 position-relative">
                            <div class="position-absolute"></div>
                        </div> -->
                        <div class="menu2_block1_element_text1">Компания</div>
                        <div class="menu2_block1_element_text2">О компании</div>
                        <div class="menu2_block1_element_text2">Контакты</div>
                    </div>
                    <div class="menu2_block1_element d-flex flex-column">
                        <div class="menu2_block1_element_text1">Каталог</div>
                        <div class="menu2_block1_element_text2">Обои</div>
                        <div class="menu2_block1_element_text2">Фотообои</div>
                        <div class="menu2_block1_element_text2">Фрески</div>
                        <div class="menu2_block1_element_text2">Лепной декор</div>
                        <div class="menu2_block1_element_text2">Клей</div>
                    </div>
                </div>
                <div class="menu2_block2 d-flex flex-column align-items-center justify-content-between">
                    <div class="menu2_block2_divider w-100 position-relative">
                        <div class="position-absolute"></div>
                    </div>
                    <div class="search d-block">
                        <form class="d-flex justify-content-center align-items-center" action="" method="GET">
                            <input name="s" placeholder="Поиск..." type="search" class="white_color">
                            <button type="submit"><img src="svg/glass.svg"></button>
                        </form>
                    </div>
                    <div class="contacts d-flex flex-column align-items-center me-4">
                        <div class="number d-flex pb-1"><a href="tel:+79922224244" class="text-decoration-none white_color">+7 (992) 222-42-44</a></div>
                        <div class="d-flex align-items-center"><a href="mailto:oboikis@yandex.ru" class="text-decoration-none white_color">oboikis<img src="svg/at.svg">yandex.ru</a></div>
                    </div>
                    <div class="menu2_block2_element d-flex justify-content-between">
                        <a href="#">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="16" r="16" fill="white"/>
                                <g clip-path="url(#clip0_427_5135)">
                                <path d="M22.332 16.8224C22.0216 16.4304 22.1104 16.256 22.332 15.9056C22.336 15.9016 24.8984 12.3608 25.1624 11.16L25.164 11.1592C25.2952 10.7216 25.164 10.4 24.5296 10.4H22.4304C21.896 10.4 21.6496 10.676 21.5176 10.9848C21.5176 10.9848 20.4488 13.5432 18.9368 15.2016C18.4488 15.6808 18.2232 15.8344 17.9568 15.8344C17.8256 15.8344 17.6216 15.6808 17.6216 15.2432V11.1592C17.6216 10.6344 17.472 10.4 17.0296 10.4H13.7288C13.3936 10.4 13.1944 10.6448 13.1944 10.8728C13.1944 11.3704 13.9504 11.4848 14.0288 12.8848V15.9224C14.0288 16.588 13.908 16.7104 13.64 16.7104C12.9264 16.7104 11.1944 14.1416 10.168 11.2016C9.96082 10.6312 9.75842 10.4008 9.22002 10.4008H7.12002C6.52082 10.4008 6.40002 10.6768 6.40002 10.9856C6.40002 11.5312 7.11362 14.244 9.71842 17.828C11.4544 20.2744 13.8992 21.6 16.1232 21.6C17.46 21.6 17.6232 21.3056 17.6232 20.7992C17.6232 18.4616 17.5024 18.2408 18.172 18.2408C18.4824 18.2408 19.0168 18.3944 20.2648 19.5744C21.6912 20.9736 21.9256 21.6 22.724 21.6H24.8232C25.4216 21.6 25.7248 21.3056 25.5504 20.7248C25.1512 19.5032 22.4536 16.9904 22.332 16.8224Z" fill="#4B729F"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_427_5135">
                                <rect width="19.2" height="19.2" fill="white" transform="translate(6.40002 6.40002)"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="16" r="16" fill="white"/>
                                <path d="M6.65901 15.8613C6.65901 15.8613 14.659 12.5781 17.4335 11.422C18.4972 10.9596 22.1041 9.4798 22.1041 9.4798C22.1041 9.4798 23.7688 8.83244 23.6301 10.4047C23.5838 11.0521 23.2139 13.3179 22.844 15.7688C22.289 19.2371 21.6879 23.0289 21.6879 23.0289C21.6879 23.0289 21.5954 24.0925 20.8093 24.2775C20.0232 24.4625 18.7283 23.6301 18.4972 23.4451C18.3121 23.3064 15.0289 21.2255 13.8266 20.2081C13.5029 19.9307 13.133 19.3758 13.8728 18.7284C15.5376 17.2024 17.526 15.3064 18.7283 14.1041C19.2833 13.5492 19.8381 12.2544 17.526 13.8266C14.2428 16.0925 11.0058 18.2197 11.0058 18.2197C11.0058 18.2197 10.2659 18.6821 8.87866 18.2659C7.49133 17.8498 5.87283 17.2948 5.87283 17.2948C5.87283 17.2948 4.76307 16.6012 6.65901 15.8613Z" fill="#34AADF"/>
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="16" r="16" fill="white"/>
                                <path d="M6.45764 25.3737L7.79219 20.5104C6.96772 19.0837 6.53466 17.4654 6.53665 15.8184C6.53882 10.6435 10.7581 6.43359 15.943 6.43359C18.4591 6.43487 20.8207 7.41214 22.5968 9.18613C24.3729 10.9601 25.3502 13.3181 25.3493 15.8259C25.347 21.0004 21.127 25.2111 15.9429 25.2111H15.9388C14.3647 25.2105 12.8179 24.8163 11.444 24.0686L6.45764 25.3737Z" fill="#57D163"/>
                                <path d="M15.9459 8.01894C11.6334 8.01894 8.1263 11.518 8.12476 15.819C8.12264 17.2876 8.53701 18.7269 9.31996 19.9704L9.50597 20.2654L8.71603 23.1438L11.6751 22.3695L11.9608 22.5384C13.1609 23.2492 14.5368 23.6253 15.94 23.626H15.943C20.2521 23.626 23.7592 20.1265 23.7609 15.8254C23.7641 14.8002 23.5636 13.7846 23.1709 12.8373C22.7782 11.89 22.2012 11.0298 21.4732 10.3066C20.7492 9.57947 19.8879 9.00286 18.9391 8.61017C17.9904 8.21749 16.973 8.01653 15.9459 8.01894Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.592 11.8949C13.4158 11.5043 13.2304 11.4964 13.0631 11.4896L12.6126 11.4841C12.4558 11.4841 12.2012 11.5428 11.9859 11.7776C11.7706 12.0124 11.1632 12.5798 11.1632 13.7339C11.1632 14.8881 12.0054 16.0033 12.1228 16.1599C12.2402 16.3166 13.7487 18.7605 16.1377 19.7008C18.1229 20.4822 18.5269 20.3268 18.958 20.2877C19.3891 20.2487 20.3485 19.7203 20.5443 19.1725C20.74 18.6247 20.7401 18.1554 20.6814 18.0573C20.6228 17.9592 20.466 17.9009 20.2308 17.7835C19.9956 17.6661 18.8403 17.0987 18.6248 17.0203C18.4094 16.942 18.2528 16.9031 18.096 17.1378C17.9391 17.3726 17.4892 17.9008 17.352 18.0573C17.2149 18.2139 17.078 18.2335 16.8427 18.1163C16.6075 17.999 15.8507 17.7512 14.9527 16.9521C14.254 16.3303 13.7824 15.5624 13.6451 15.3278C13.5078 15.0931 13.6306 14.966 13.7484 14.8491C13.8539 14.744 13.9834 14.5752 14.1011 14.4383C14.2189 14.3014 14.2576 14.2035 14.3359 14.0472C14.4141 13.8909 14.3751 13.7536 14.3163 13.6363C14.2575 13.5191 13.8008 12.3588 13.592 11.8949Z" fill="#57D163"/>
                            </svg>   
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>