<script setup>
import Topbar from '@/Components/Public/Topbar.vue';
import Footer from '@/Components/Public/Footer.vue';
import { ref } from 'vue';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
    productItems: Array,
    productGalleries: Array,
    productSizes: Array,
    productColors: Array,
});

const product = ref(props.product);
const productItems = ref(props.productItems);
const productGalleries = ref(props.productGalleries);
const productColors = ref(props.productColors);

const form = useForm({

});

const options = ref({
    type: 'carousel',
    perPage: 1,
    perMove: 1,
    width: '100%',
    gap: '1rem',
    padding: { left: 0, right: 0 },
    rewind: true,
    autoplay: true,
});

const formatBody = (body) => {
    return body.split('\n').map(paragraph => `<p>${paragraph.trim()}</p>`).join('');
};

</script>


<template>
    <Topbar/>
    <div class="font-lora m-5">
        <div class="productitem font-lora mx-auto px-4" v-if="product">
            <div class="flex justify-center">
                <div class="ab w-full h-10 flex items-center space-x-2">
                    <a href="/" class="text-lg flex flex-row items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 ml-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ml-2">Trang chủ</span>
                    </a>
                    <span class="mx-2">|</span>
                    <a :href="route('product')" class="text-lg">Sản phẩm - {{ product.product_name }}</a>
                </div>
            </div>
            <hr class="mt-4 mb-6 hidden sm:block">
            <div class="grid grid-cols-2 md:grid-cols-2 gap-8">
                <div class="cols-span-1 w-full">
                    <Splide :options="options">
                        <SplideSlide v-for="(gallery, index) in productGalleries" :key="index">
                            <img :src="'/image_productgall/' + gallery.image" class="w-full h-auto object-cover shadow-lg" alt="">
                        </SplideSlide>
                    </Splide>
                </div>
                <div class="cols-span-1">
                    <div class="w-full">
                        <div class="flex flex-row sm:flex-row items-start sm:items-center">
                            <h2 class="text-2xl font-bold mb-0 sm:mb-4 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                {{ product.product_name }}
                            </h2>
                            <span class="mx-2 text-2xl font-bold mb-0 sm:mb-4 whitespace-nowrap overflow-hidden overflow-ellipsis"> / </span>
                            <div class="text-2xl font-bold mb-0 sm:mb-4 whitespace-nowrap overflow-hidden overflow-ellipsis">
                                <div v-for="(color, index) in productColors" :key="index">
                                    {{ color.color_name }}
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="pt-5 flex items-center text-2xl mb-4" v-if="productItems && productItems.length > 0">
                        <span class="text-red-500 mr-2 font-semibold">{{ productItems[0].discount_price }},000đ</span>
                        <span class="line-through text-gray-400">{{ productItems[0].price }},000đ</span>
                    </div>
                    <hr>
                    <div class="flex items-center space-x-4 pt-5 pb-5">
                        <button v-for="(size, index) in productSizes" :key="index" class="w-14 h-12 flex items-center justify-center text-white bg-red-700 border border-red-700 hover:bg-red-500 focus:border-red-700 focus:bg-white focus:text-black active:bg-red-600">
                            {{ size.size }}
                        </button>
                    </div>
                    <hr class="mb-4">
                    <a :href="route('cart.add', product.id)">
                        <button class="bt-xemthem p-4 text-white bg-red-900 border border-red-900 hover:bg-red-700 hover:border-red-700 transition-all duration-300 transform" type="submit">
                            Thêm vào giỏ
                        </button>
                    </a>
                </div>
            <div class="i-mota mt-12 w-full">
                <h2 class="text-3xl flex justify-center font-bold mb-8">Mô tả</h2>
                <div class="i-bangsize flex justify-center mb-8">
                    <img src="../../../../../public/images/sizechart.jpg" alt="Size chart" class="w-full max-w-md object-cover">
                </div>
                <div class="leading-relaxed mb-4" v-html="formatBody(product.description)"></div>
                <p class="leading-7 text-gray-700">
                    Bảng size <br>
                    S: Dài 69 Rộng 52.5 | 1m50 - 1m65, 45 - 55Kg <br>
                    M: Dài 73 Rộng 55 | 1m60 - 1m75, 50 - 65Kg <br>
                    L: Dài 76.5 Rộng 57.5 | 1m7 - 1m8, 65Kg - 80Kg <br>
                    👉 Nếu chưa biết lựa size bạn có thể inbox để được chúng mình tư vấn. <br>
                    <br>‼️LƯU Ý ▪️Khi giặt sản phẩm bằng tay: Vui lòng hoà tan kĩ nước giặt, bột giặt với nước sau đó mới cho sản phẩm vào. ▪️Khi giặt sản phẩm bằng máy giặt: Vui lòng đổ nước giặt, bột giặt vào khay của máy.
                    <br>🚫TUYỆT ĐỐI KHÔNG đổ nước giặt, bột giặt trực tiếp vào sản phẩm. Như vậy sẽ ảnh hưởng đến màu sắc của sản phẩm và làm cho áo có tình trạng loang màu. Dâu store xin cảm ơn ạ🖤
                    <br>🔹 Chính sách đổi trả.
                    <br> - Miễn phí đổi hàng cho khách mua ở Outerity trong trường hợp bị lỗi từ nhà sản xuất, giao nhầm hàng, nhầm size.
                    <br> - Quay video mở sản phẩm khi nhận hàng, nếu không có video unbox, khi phát hiện lỗi phải báo ngay cho Dâu trong 1 ngày tính từ ngày giao hàng thành công. Qua 1 ngày chúng mình không giải quyết khi không có video unbox.
                    <br> - Sản phẩm đổi trong thời gian 3 ngày kể từ ngày nhận hàng
                    <br> - Sản phẩm còn mới nguyên tem, tags, sản phẩm chưa giặt và không dơ bẩn, hư hỏng bởi những tác nhân bên ngoài cửa hàng sau khi mua hàng.
                </p>
            </div>
                </div>
            </div>
        </div>
    </div>
    <Footer/>
</template>

<style scoped>
@media (max-width: 640px) {
    .ab {
        display: none;
    }
}

.bt-xemthem {
    padding: 0.65em 2em; /* Giảm kích thước padding */
    font-size: 1em; /* Giảm kích thước font */
    background-color: #9a0a11; /* Màu nền đỏ */
    border: 0.1em solid #9a0a11; /* Độ rộng border */
    color: white; /* Màu chữ trắng */
    cursor: pointer;
    overflow: hidden;
    position: relative;
    transition: color 0.3s, background-color 0.3s, transform 0.3s; /* Thêm transition cho màu, nền và transform */
}

.bt-xemthem::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%; /* Bắt đầu với vị trí bên trái ngoài màn hình */
    width: 100%; /* Kích thước mặc định của pseudo-element */
    height: 100%;
    background-color: white; /* Màu nền trắng */
    z-index: -1;
    transition: left 0.3s; /* Thêm transition cho left */
}

.bt-xemthem:hover::before {
    left: 0; /* Khi hover, dịch chuyển pseudo-element từ trái vào trong */
}

.bt-xemthem:hover {
    color: #9a0a11; /* Khi hover, chữ chuyển sang màu đỏ */
    background-color: transparent; /* Khi hover, chuyển từ đỏ sang trong suốt */
}

.bt-xemthem-container {
    display: flex;
    justify-content: center;
}

.group:hover {
    filter: none;
}
</style>

