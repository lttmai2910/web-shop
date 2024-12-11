<script setup>
import Topbar from '@/Components/Public/Topbar.vue';
import Footer from '@/Components/Public/Footer.vue';
import { ref, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps({
    cart: Object,
    product: Object,
    productItems: Array,
    productGalleries: Array,
    productSizes: Array,
    productColors:Array,
    totalPrice: Number, // Đảm bảo props 'totalPrice' là một số
});

const form = useForm({});

function destroy(id) {
        if (confirm("Bạn có chắc là muốn xóa nó chứ")) {
            form.delete(route('cart.destroy', id));
        }
    }

function increaseQuantity(id) {
    form.put(route('cart.updateQuantity', { id, action: 'increase' }));
}

function decreaseQuantity(id) {
    form.put(route('cart.updateQuantity', { id, action: 'decrease' }));
}
function updateQuantity(id, quantity) {
    if (quantity == 0) {
        // Chỉ xử lý khi người dùng chọn "OK" trong thông báo confirm
        if (confirm("Bạn có chắc muốn xóa sản phẩm khỏi giỏ hàng?")) {
            // Gửi yêu cầu PUT để cập nhật số lượng
            form.put(route('cart.updateQuantity', { id, action: 'update', quantity }));
        } else {
            return;
        }
    } else {
        // Gửi yêu cầu PUT để cập nhật số lượng
        form.put(route('cart.updateQuantity', { id, action: 'update', quantity }));
    }
}

const formatMoney = (value) => {
    return new Intl.NumberFormat('en-US').format(value*1000) 
}
</script>

<template>
    <div class="page-container">
        <Topbar />
        <div class="content-container">
            <div class="cart font-lora mt-10 mb-20">
                <div class="flex flex-col items-center mt-8">
                    <h1 class="text-3xl font-bold uppercase">Giỏ hàng của bạn</h1>
                    <div class="border-t border-black border-solid border-2 w-16 mt-10"></div>
                </div>

                <div class="flex flex-wrap mt-8 pl-5 pr-5 lg:pl-20 lg:pr-10">
                    <div class="w-full lg:w-2/3 mb-8 lg:mb-0">
                        <!-- Kiểm tra nếu có sản phẩm trong giỏ hàng -->
                        <div v-if="cart && Object.keys(cart).length > 0">
                            <div v-for="(item, index) in cart" :key="index" class="c-product flex justify-center h-54 m-5 p-5 shadow shadow-red-900">
                                <div class="flex w-full lg:w-1/2">
                                    <div class="p-2 mr-2">
                                        <img :src="'/image_productgall/' + item.image" class="w-40 h-40 object-cover" :alt="item.product_name">
                                    </div>
                                    <div class="flex flex-col justify-between">
                                        <div>
                                            <p class="">{{ item.product_name }}</p>
                                            <div class="flex mb-2">
                                                <p class="text-red-500 mr-2">{{ item.discount_price }},000đ</p>
                                                <p class="line-through text-gray-400">{{ item.price }},000đ</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-4 pt-5">
                                            <span v-if="item.sizes && item.sizes.length > 0" class="text-gray-500 text-sm">Sizes: 
                                                <span v-for="(size, sizeIndex) in item.sizes" :key="sizeIndex">
                                                    {{ size }}
                                                    <span v-if="sizeIndex < item.sizes.length - 1">, </span>
                                                </span>
                                            </span>
                                            <span v-else class="text-gray-500 text-sm">Sizes not available</span>
                                        </div>  
                                        
                                        <div class="flex items-center space-x-4">
                                                <span v-if="item.color_name" class="text-gray-500 text-sm">Màu: {{ item.color_name }}</span>
                                                <span v-else class="text-gray-500 text-sm">Color not available</span>
                                            </div>
                                        
                                        <div class="flex items-center space-x-4">
                                            <button @click="decreaseQuantity(item.id)" class="w-10 h-10 flex items-center justify-center text-white bg-red-700 border hover:border-red-700 hover:bg-white hover:text-black active:bg-red-600">-</button>
                                            <input type="text" class="w-16 h-10 text-center border border-gray-300 rounded" :value="item.quantity" @change="updateQuantity(item.id, $event.target.value)">
                                            <button @click="increaseQuantity(item.id)" class="w-10 h-10 flex items-center justify-center text-white bg-red-700 border hover:border-red-700 hover:bg-white hover:text-black active:bg-red-600">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full lg:w-1/2 p-2 list-none relative">
                                    <ul class="pl-10">
                                        <li class="absolute top-0 right-0">
                                            <form :id="'remove-form-' + item.id" method="POST" :action="route('cart.destroy', item.id)">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="#" @click.prevent="destroy(item.id)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </a>
                                            </form>
                                        </li>
                                        <li class="absolute bottom-0 right-0 font-bold text-2xl text-red-500">{{ item.discount_price * item.quantity }},000đ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Nếu không có sản phẩm trong giỏ hàng, hiển thị thông báo -->
                        <div v-else>
                            <p class="text-xl ml-5">Giỏ hàng của bạn đang trống</p>
                        </div>
                        <!-- Ghi chú đơn hàng và Chính sách mua hàng -->
                        <div class="c-note flex p-5 mt-8">
                            <div>
                                <p class="font-bold text-xl">Ghi chú đơn hàng</p>
                                <textarea id="description" name="description" class="mt-1 p-2 block w-full lg:w-96 h-24 bg-gray-100 shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md"></textarea>
                            </div>
                            <div class="pl-5">
                                <p class="font-bold text-xl">Chính sách mua hàng</p>
                                <ul class="mt-2">
                                    <li class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 p-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                        </svg>
                                        Sản phẩm được đổi 1 lần duy nhất, không hỗ trợ trả.
                                    </li>
                                    <li class="flex items-center space-x-2 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 p-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                        </svg>
                                        Sản phẩm còn đủ tem mác, chưa qua sử dụng.
                                    </li>
                                    <li class="flex items-center space-x-2 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 p-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                        </svg>
                                        Sản phẩm nguyên giá được đổi trong 30 ngày trên toàn hệ thống.
                                    </li>
                                    <li class="flex items-center space-x-2 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 p-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                        </svg>
                                        Sản phẩm sale chỉ hỗ trợ đổi size trong 7 ngày trên toàn hệ thống.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 lg:pl-7">
                        <div class="border w-full lg:w-96 h-auto mt-4 p-4 bg-white shadow-lg rounded-lg">
                            <p class="mt-2 text-xl font-bold mb-6 text-gray-800">Thông tin đơn hàng</p>
                            
                            <hr class="mb-4">

                            <div class="flex items-center justify-between text-xl mt-2 mb-4">
                                <p class="font-bold text-lg text-gray-600">Tổng tiền:</p>
                                <p v-if="Object.keys(cart).length > 0" class="font-bold text-xl text-red-500 pl-4">
                                    {{ formatMoney(totalPrice) }} vnđ
                                </p>
                            </div>

                            <hr class=" mb-4">

                            <p class="mb-6 text-gray-600">
                                Phí vận chuyển sẽ được tính ở trang thanh toán.<br>
                                Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.
                            </p>

                            <a :href="route('cart.pay')" class="flex justify-center mb-6">
                                <button class="bt-xemthem w-full lg:w-96 rounded-lg p-3 text-white bg-red-900 border-2 border-red-900">
                                    <a class="link">Thanh toán</a>
                                </button>
                            </a>

                            <a :href="route('product')" class="back-link text-gray-400 flex items-center justify-center space-x-2 my-2 transition duration-150 ease-in-out hover:text-gray-900 hover:bg-transparent hover:outline-none hover:ring-0">
                                <svg class="w-6 h-6 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.502 7.046h-2.5v-.928a2.122 2.122 0 0 0-1.199-1.954 1.827 1.827 0 0 0-1.984.311L3.71 8.965a2.2 2.2 0 0 0 0 3.24L8.82 16.7a1.829 1.829 0 0 0 1.985.31 2.121 2.121 0 0 0 1.199-1.959v-.928h1a2.025 2.025 0 0 1 1.999 2.047V19a1 1 0 0 0 1.275.961 6.59 6.59 0 0 0 4.662-7.22 6.593 6.593 0 0 0-6.437-5.695Z"/>
                                </svg>
                                <span class="ml-2">Tiếp tục mua hàng</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>

<style>
.page-container {
display: flex;
flex-direction: column;
min-height: 100vh;
}

.content-container {
flex: 1;
}

.bt-xemthem {
    position: relative;
    overflow: hidden;
    transition: color 0.4s ease;
}

.bt-xemthem::before {
    content: ' ';
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    color: black;
    background-color: white;
    border-color: #9a0a11;
    transition: left 0.4s ease;
    z-index: 0;
}

.bt-xemthem:hover::before {
    left: 0;
}

.bt-xemthem:hover {
    color: #9a0a11;
}

.back-link {
    transition: color 0.3s ease; /* Thêm transition cho màu chữ */
}

.back-link:hover {
    color: #9a0a11; /* Màu chữ khi hover */
}

.back-link svg {
    transition: transform 0.3s ease; /* Thêm transition cho transform */
}

.back-link:hover svg {
    color: #9a0a11;
    transform: translateX(-5px); /* Dịch chuyển svg sang phải khi hover */
}

a.text-red-600:hover {
    text-decoration: underline;
}

@media (min-width: 640px) {
    /* Điều chỉnh các phần tử cho màn hình lớn hơn 640px */
    .c-product {
        flex-direction: row; /* Các sản phẩm trong giỏ hàng sẽ hiển thị cạnh nhau trên màn hình lớn hơn 640px */
    }

    .c-note {
        flex-direction: row; /* Ghi chú đơn hàng và chính sách mua hàng sẽ hiển thị cạnh nhau trên màn hình lớn hơn 640px */
    }
}
</style>
