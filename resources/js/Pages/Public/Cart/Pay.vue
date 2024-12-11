<script setup>
import Topbar from '@/Components/Public/Topbar.vue';
import Footer from '@/Components/Public/Footer.vue';
import { ref, computed, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
defineProps({
    cart: Array,
    data: Array,
});

const {session} = usePage().props;

const form = useForm({
    name_customer: session.customer ? session.customer.name_customer : '',
    email: session.customer ? session.customer.email : '',
    phone: session.customer ? session.customer.phone : '',
    address: session.customer ? session.customer.address : '',
    name_payment: '', 
    note: '',
});

const submitOrder = () => {
    if (!form.name_customer) {
        alert('Vui lòng nhập tên khách hàng.');
        return;
    }
    if (!form.email) {
        alert('Vui lòng nhập email.');
        return;
    }
    if (!form.email.endsWith('@gmail.com')) {
        alert('Email phải có đuôi @gmail.com.');
        return;
    }
    if (!form.phone) {
        alert('Vui lòng nhập số điện thoại.');
        return;
    }
    let phoneNumber = form.phone.replace(/\D/g, ''); // Loại bỏ các ký tự không phải số
    if (phoneNumber.length < 10 || phoneNumber.length > 11) {
        alert('Số điện thoại phải có từ 10 đến 11 số.');
        return;
    }
    if (!form.address) {
        alert('Vui lòng nhập địa chỉ.');
        return;
    }
    if (!form.name_payment) {
        alert('Vui lòng nhập phương thức thanh toán.');
        return;
    }
    form.post(route('cart.checkout'), {
        onSuccess: () => {
            console.log('Đặt hàng thành công!');
            alert('Bạn đã đặt hàng thành công!');

        },
        onError: (errors) => {
            console.error('Đặt hàng thất bại!', errors);
            alert('Đặt hàng không thành công! Vui lòng thử lại!');
        }
    });
};

const selectedProvince = ref('');
    const selectedDistrict = ref('');
    const selectedWard = ref('');

    const updateAddress = () => {
        form.address = `${selectedWard.value ? selectedWard.value + ', ' : ''}${selectedDistrict.value ? selectedDistrict.value + ', ' : ''}${selectedProvince.value}`;
    };
    const fetchProvinces = () => {
        fetch('https://esgoo.net/api-tinhthanh/4/0.htm')
            .then(response => response.json())
            .then(data => {
                const provinceSelect = document.getElementById('province');
                provinceSelect.innerHTML = `<option value=''>Chọn Tỉnh/ Thành</option>`;
                data.data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.name;
                    option.textContent = province.name;
                    provinceSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Lỗi khi gọi API', error);
            });
    };

    const fetchDistricts = (provinceName) => {
        fetch(`https://esgoo.net/api-tinhthanh/4/0.htm`)
            .then(response => response.json())
            .then(data => {
                const province = data.data.find(province => province.name === provinceName);
                const districts = province ? province.data2 : [];
                const districtSelect = document.getElementById('districts');
                districtSelect.innerHTML = `<option value=''>Chọn Quận/ Huyện</option>`;
                if (districts) {
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.name;
                        option.textContent = district.name;
                        districtSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Lỗi khi gọi API', error);
            });
    };

    const fetchWards = (districtName) => {
        fetch(`https://esgoo.net/api-tinhthanh/4/0.htm`)
            .then(response => response.json())
            .then(data => {
                let wards = [];
                data.data.forEach(province => {
                    province.data2.forEach(district => {
                        if (district.name === districtName) {
                            wards = district.data3;
                        }
                    });
                });
                const wardSelect = document.getElementById('wards');
                wardSelect.innerHTML = `<option value=''>Chọn Phường/ Xã</option>`;
                if (wards) {
                    wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.name;
                        option.textContent = ward.name;
                        wardSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Lỗi khi gọi API', error);
            });
    };

    const getProvinces = (event) => {
        selectedProvince.value = event.target.value;
        fetchDistricts(event.target.value);
        updateAddress();
    };

    const getDistricts = (event) => {
        selectedDistrict.value = event.target.value;
        fetchWards(event.target.value);
        updateAddress();
    };

    const getWards = (event) => {
        selectedWard.value = event.target.value;
        updateAddress();
    };

    onMounted(() => {
        fetchProvinces();
    });
</script>

<template>
    <div class="pay font-lora">
      <div class="grid grid-cols-1 md:grid-cols-2 w-full min-h-screen">
        <div class="p-8">
          <p class="font-bold text-5xl">Dâu Store</p>
          <p class="mt-4">Thông tin giao hàng</p>
          <!-- <p class="mb-4">
            Bạn đã có tài khoản? 
            <a href="" class="text-red-600 hover:text-red-400">Đăng nhập</a>
          </p> -->
          <form @submit.prevent="submitOrder">
            <div class="mb-4">
              <input 
                v-model="form.name_customer" 
                type="text" 
                placeholder="Họ và tên*" 
                class="mt-1 p-2 block w-full md:w-96 shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md" 
              />
            </div>
            <div class="flex flex-wrap mb-4 gap-4">
              <div class="w-full md:w-1/2">
                <input 
                  v-model="form.email" 
                  type="email" 
                  placeholder="Email*" 
                  class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md" 
                />
              </div>
              <div class="w-full md:w-1/2">
                <input 
                  v-model="form.phone" 
                  type="text" 
                  placeholder="Số điện thoại*" 
                  maxlength="11"
                  class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md" 
                />
              </div>
            </div>
            <div class="flex flex-wrap mb-4 gap-4">
                <div class="flex-grow">
                    <select 
                        id="province" 
                        @change="getProvinces" 
                        class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md"
                    >
                        <option value="0">Tỉnh/ Thành</option>
                    </select>
                </div>
                <div class="flex-grow">
                    <select 
                        id="districts" 
                        @change="getDistricts" 
                        class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md"
                    >
                        <option value="0">Quận/ Huyện</option>
                    </select>
                </div>
                <div class="flex-grow">
                    <select 
                        id="wards" 
                        @change="getWards"  
                        class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md"
                    >
                        <option value="0">Phường/ Xã</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
              <input 
                v-model="form.address" 
                type="text" 
                placeholder="Địa chỉ*" 
                class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md" 
              />
            </div>
            <div class="mb-4">
              <p class="font-bold text-xl">Phương thức thanh toán*</p>
              <select 
                v-model="form.name_payment" 
                class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md"
              >
                <option disabled value="">Chọn phương thức</option>
                <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                <option value="Thanh toán VNPay">Thanh toán VNPay</option>
              </select>
            </div>
            <div class="mb-4">
              <p class="font-bold text-xl">Ghi chú đơn hàng</p>
              <textarea 
                v-model="form.note" 
                class="mt-1 p-2 block w-full h-24 bg-gray-100 shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md"
              ></textarea>
            </div>
            <button 
              type="submit" 
              class="bt-xemthem mt-3 p-5 bg-red-900 border-2 border-red-900 text-white"
            >
              Xác nhận đặt hàng
            </button>
          </form>
        </div>
        <div class="h-full p-10 bg-gray-100">
            <div v-for="(item, index) in cart" :key="index" class="c-product grid grid-cols-1 md:grid-cols-2 h-auto m-5 shadow bg-white p-4 rounded-md">
                <div class="flex">
                    <img :src="'/image_productgall/' + item.image" :alt="item.product_name" class="w-28 h-28 object-cover rounded-sm">
                    <div class="pl-4 flex flex-col justify-between">
                        <div>
                            <p class="font-semibold">{{ item.product_name }}</p>
                            <div class="flex items-center">
                                <p class="text-red-500 mr-2">{{ item.discount_price }}.000đ</p>
                                <p class="line-through text-gray-400">{{ item.price }}.000đ</p>
                            </div>
                            <p class="text-red-500 mr-2" id="discount_price">Số lượng: {{ item.quantity }}</p>
                        </div>
                        <div>
                            <span v-if="item.sizes && item.sizes.length > 0" class="text-gray-500 text-sm">Sizes: 
                                <span v-for="(size, sizeIndex) in item.sizes" :key="sizeIndex">
                                    {{ size }}
                                    <span v-if="sizeIndex < item.sizes.length - 1">, </span>
                                </span>
                            </span>
                            <span v-else class="text-gray-500 text-sm">Sizes not available</span>
                        </div>
                        <div class="flex items-center">
                            <p class="text-gray-500 text-sm pr-2">Màu: {{ item.color_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-end md:flex-col md:items-end mt-auto">
                    <div class="font-bold text-2xl text-red-500">{{ item.discount_price * item.quantity }}.000đ</div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </template>

<style scoped>
.group:hover {
    filter: none;
}

.bt-xemthem-container {
    display: flex;
    justify-content: center;
}

.bt-xemthem {
    padding: 0.5em 2em;
    font-size: 1em;
    background-color: #9a0a11;
    border: 0.1em solid #9a0a11;
    color: white;
    cursor: pointer;
    overflow: hidden;
    transition: color 0.5s, background-color 0.5s;
}

.bt-xemthem::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background-color: white;
    z-index: -1;
    transition: left 0.5s;
}

.bt-xemthem:hover::before {
    left: 0;
}

.bt-xemthem:hover {
    color: #9a0a11;
    background-color: transparent;
    transform: scaleX(1);
    transform-origin: left;
}
</style>
