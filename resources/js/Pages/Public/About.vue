<script setup>
    import Topbar from '@/Components/Public/Topbar.vue';
    import Footer from '@/Components/Public/Footer.vue';
    import Pagination from '@/Components/Pagination.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    defineProps({
        post: Object, 
    });
    
    const form=useForm({
        
    });
</script>
<template>
    <div class="page-container">
    <Topbar />
    <div class="content-container">
        <div class="font-lora m-5">
            <div class="flex justify-center">
                <div class="ab w-full h-10 flex items-center space-x-2">
                    <a href="/" class="text-lg flex flex-row items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ml-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ml-2">Trang chủ</span>
                    </a>
                    <span class="mx-2">|</span>
                    <p class="text-lg">Giới thiệu về Dâu Store </p>
                </div>
            </div>
            <hr class="mt-4 mb-6 hidden sm:block">
                <div class="flex justify-center items-center">
                    <div class="border-t border-black w-32 mr-2"></div>
                    <p class="text-3xl font-bold uppercase">Giới thiệu</p>
                    <div class="border-t border-black w-32 ml-2"></div>
                </div>
            <hr class="mt-4 mb-6">
            <div class="ab-body w-auto h-auto flex justify-center">
                    <img class = "w-full object-cover" src="/images/postergioithieu.png" alt="" srcset="">
            </div>
            <hr class="mt-6 mb-6">
            <div class="ab-content text-xl mx-auto max-w-8xl">
                <div class="ab-ct-1 flex justify-between m-5 p-5 bg-white shadow hover:drop-shadow-xl hover:shadow-red-400">
                    <div class="w-full md:w-2/3 flex items-center justify-center md:justify-start">
                        <p class="first-letter:text-6xl font-script mb-5 ">D</p>
                        <p class="ml-2 text-lg leading-relaxed font-lora">
                            âu Store là một thương hiệu thời trang dành cho giới trẻ. 
                            <br>
                            âu Store được lấy ý tưởng từ quả dâu tây - biểu tượng của thần vệ nữ, nữ thần tình yêu.
                        </p>
                    </div>
                    <div class="ml-2 w-full md:w-1/3 flex justify-center md:justify-end">
                        <img src="/images/gioithieu1.jpg" alt="" class="w-5/4 h-auto object-cover rounded-lg">
                    </div>
                </div>

                <div class="ab-ct-2 flex justify-center text-3xl m-5 underline hover:text-red-500 transition duration-500 transform hover:scale-110">
                    <p class="font-bold hover:text-red-600"> Bạn có thích màu đỏ không ?</p>
                    <p class="text-lg ml-1"> Đặc trưng của Dâu Store là màu đỏ đô. </p>  
                </div>

                <div class="ab-body-con">
                    <div class="ab-ct-1 flex items-center justify-center m-5 p-5 bg-white shadow hover:drop-shadow-xl hover:shadow-red-400"> 
                        <div class="ab-ct-img w-1/3 flex justify-center brightness-100 hover:brightness-110 transition duration-300"> 
                            <img src="/images/gioithieu2.jpg" alt="" class="w-5/4 h-auto object-cover rounded-lg">
                        </div>
                        <div class="m-5 w-2/3 flex justify-center"> 
                            <div>
                                <p class="ab-text flex justify-center uppercase"> Đỏ là một màu sắc nịnh da </p>
                                <br>
                                <p class="indent-6">Bạn có biết đỏ là một trong những gam màu tôn da hiệu quả ?
                                Những ai có làn da không được hồng hào, mặc màu đỏ chính là cách để bạn trông rạng rỡ hơn. 
                                Đối với những nàng sở hữu làn da trắng sáng, sắc đỏ lại giúp bạn trở thành trung tâm thu hút sự chú ý.</p>
                            </div>
                        </div>            
                    </div>
    
                    <div class="ab-ct-1 flex items-center justify-center m-5 p-5 bg-white shadow hover:drop-shadow-xl hover:shadow-red-400"> 
                        <div class="m-5 w-2/3 flex justify-center"> 
                            <div>
                                <p class="ab-text flex justify-center uppercase"> Màu đỏ là biểu tượng của sự may mắn </p> 
                                <br>
                                <p class="indent-6">Theo quan niệm từ ngày xưa đến nay, màu đỏ luôn là tượng trưng cho may mắn, cho sự sôi động và mãnh liệt. 
                                Đó cũng là lý do vì sao cảm hứng vô tận và sức hấp dẫn khiến trang phục màu đỏ là lựa chọn ưu tiên trong mỗi dịp năm mới.</p>
                            </div>                    
                        </div>
                        <div class="ab-ct-img w-1/3 flex justify-center brightness-100 hover:brightness-110 transition duration-300"> 
                            <img src="/images/gioithieu3.jpg" alt="" class="w-5/4 h-auto object-cover rounded-lg">
                        </div>
                    </div>
                        
                    <div class="ab-ct-1 flex items-center justify-center m-5 p-5 bg-white shadow hover:drop-shadow-xl hover:shadow-red-400"> 
                        <div class="ab-ct-img w-1/3 flex justify-center brightness-100 hover:brightness-110 transition duration-300"> 
                            <img src="/images/gioithieu4.jpg" alt="" class="w-5/4 h-auto object-cover rounded-lg">
                        </div>
                        <div class="m-5 w-2/3 flex justify-center"> 
                            <div>
                                <p class="ab-text flex justify-center uppercase"> Màu đỏ giúp bạn thêm cuốn hút</p> 
                                <br>
                                <p class="indent-6"> Màu đỏ là một tone màu mạnh và rất thu hút sự chú ý, nó bao gồm cả nét sang trọng và kiêu hãnh như đóa hoa hồng đỏ của người phụ nữ.
                                Đó là điều không thể phủ nhận khi bước xuống đường phố hay trong bất cứ bữa tiệc đông đúc nào thì bạn cũng sẽ dễ dàng bị thu hút bởi sắc màu nổi bật này. </p>
                            </div>
                        </div>
                    </div>

                    <div class="ab-ct-1 flex items-center justify-center m-5 p-5 bg-white shadow hover:drop-shadow-xl hover:shadow-red-400"> 
                        <div class="m-5 w-2/3 flex justify-center">
                            <div>
                                <p class="ab-text flex justify-center uppercase"> Đỏ không bao giờ lỗi mốt</p> 
                                <br>
                                <p class="indent-6"> Trong thế giới thời trang, màu đỏ dường như không bao giờ bị lãng quên, cho dù bánh xe thời trang có xoay chuyển bao nhiêu vòng đi chăng nữa.
                                Sở hữu sắc đỏ trong tủ đồ, các quý cô có thể hoàn toàn yên tâm về tính xu hướng cũng như nét thời thượng mà các trang phục đỏ mang lại.</p>
                            </div>                 
                        </div>
                        <div class="ab-ct-img w-1/3 flex justify-center brightness-100 hover:brightness-110 transition duration-300"> 
                            <img src="/images/gioithieu5.jpg" alt="" class="w-5/4 h-auto object-cover rounded-lg">
                        </div>
                    </div> 
                </div>      
            </div>
        </div>
    </div>
    <Footer/>
    </div>
</template>

<style scoped>
@media (max-width: 640px) {
    .ab {
        display: none;
    }
}

.page-container {
display: flex;
flex-direction: column;
min-height: 100vh;
}

.content-container {
flex: 1;
}

/* Thay đổi kiểu chữ và căn lề cho các đoạn văn */
.ab-content p {
font-size: 1.1rem;
line-height: 1.6;
text-align: justify; /* Căn lề cho các đoạn văn */
}

/* Tạo kiểu chữ đậm cho các đoạn văn đặc biệt */
.ab-text {
font-weight: bold;
}

/* Thay đổi màu chữ khi hover */
.ab-text:hover {
color: red;
}
</style>