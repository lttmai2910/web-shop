<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js'; // Adjust path as per your project structure

const form = useForm({
    name_customer: '',
    password: '',
    phone: '',
    email: '',
    birthday: '',
    address: '',
    gender: '',
});

const submitForm = () => {
    let phoneNumber = form.phone.replace(/\D/g, ''); // Loại bỏ các ký tự không phải số
    if (phoneNumber.length < 10 || phoneNumber.length > 11) {
        alert('Số điện thoại phải có từ 10 đến 11 số.');
        return;
    }
    form.post(route('register.store'))
};

</script>

<template>
    <section class="h-screen flex items-center justify-center bg-gray-100 font-lora">
    <div class="container h-full px-6 py-24">
      <div class="flex h-full flex-wrap items-center justify-center lg:justify-between">
        <!-- Left column container with background -->
        <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
          <img
            src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="w-full"
            alt="Phone image"
          />
        </div>
        <div class="md:w-8/12 lg:ms-6 lg:w-5/12 bg-white p-8 rounded-lg shadow-lg">
          <h2 class="text-2xl font-semibold mb-6 text-center uppercase">Đăng ký</h2>
          <form @submit.prevent="submitForm">
            <div class="relative mb-6">
                <input
                    type="text"
                    class="input-field focus:ring-red-500"
                    id="name_customer"
                    placeholder=" "
                    v-model="form.name_customer"
                    required
                />
                <label for="name_customer" class="input-label">Tên khách hàng</label>
            </div>

            <!-- Trường nhập liệu Mật khẩu -->
            <div class="relative mb-6">
                <input
                    type="password"
                    class="input-field focus:ring-red-500"
                    id="password"
                    placeholder=" "
                    minlength="8"
                    v-model="form.password"
                    required
                />
                <label for="password" class="input-label">Mật khẩu</label>
            </div>

            <!-- Trường nhập liệu Số điện thoại -->
            <div class="relative mb-6">
                <input
                    type="text"
                    class="input-field focus:ring-red-500"
                    id="phone"
                    placeholder=" "
                    maxlength="11"
                    v-model="form.phone"
                    required
                />
                <label for="phone" class="input-label">Số điện thoại</label>
            </div>

            <!-- Trường nhập liệu Email -->
            <div class="relative mb-6">
                <input
                    type="email"
                    class="input-field focus:ring-red-500"
                    id="email"
                    placeholder=" "
                    v-model="form.email"
                    @input="validateEmail"
                    required
                />
                <label for="email" class="input-label">Email</label>
                <p v-if="emailError" class="error-message">{{ emailError }}</p>
            </div>

            <!-- Trường nhập liệu Địa chỉ -->
            <div class="relative mb-6">
                <input
                    type="text"
                    class="input-field focus:ring-red-500"
                    id="address"
                    placeholder=" "
                    v-model="form.address"
                />
                <label for="address" class="input-label">Địa chỉ</label>
            </div>

                        <!-- Trường nhập liệu Ngày sinh -->
            <div class="relative mb-2">
                <input
                    type="date"
                    class="input-field focus:ring-red-500"
                    id="birthday"
                    placeholder=" "
                    v-model="form.birthday"
                />
                <label for="birthday" class="input-label">Ngày sinh</label>
            </div>


            <!-- Trường chọn Giới tính -->
            <div class="mb-2 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <label for="status_active" class="inline-flex items-center">
                    <input type="radio" id="gender" v-model="form.gender" value="0" class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-400">
                    <span class="ml-2 px-4 py-2">Nữ</span>
                </label>
                <label for="status_inactive" class="inline-flex items-center">
                    <input type="radio" id="gender" v-model="form.gender" value="1" class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-400">
                    <span class="ml-2 px-4 py-2">Nam</span>
                </label>
            </div>

            <button
              type="submit"
              class="bt-xemthem w-full mb-4"
            >
              Đăng ký
            </button>

            <a
                :href="route('login.index')"
                class="register-link text-gray-400 flex items-center justify-center space-x-2 transition duration-150 ease-in-out"
                @click="register"
              >
                <svg class="w-6 h-6 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            <span>Quay lại</span>
                
            </a>
        </form>
    </div>
    </div>
    </div>
    </section>
</template>

<style scoped>
.input-field {
  width: 100%;
  min-height: auto;
  padding: 1rem 1.5rem;
  border-radius: 0.5rem;
  border: 1px solid #E5E7EB;
  transition: border-color 0.3s ease;
}

.input-field:focus {
  outline: none;
  border-color: #DC2626;
}

.input-label {
  position: absolute;
  left: 1.5rem;
  top: 1rem;
  margin-bottom: 0;
  max-width: calc(100% - 3rem);
  transform-origin: 0 0;
  pointer-events: none;
  font-size: 0.875rem;
  color: #9CA3AF;
  transition: transform 0.3s ease, color 0.3s ease;
}

.input-field:focus + .input-label,
.input-field:not(:placeholder-shown) + .input-label {
  transform: translateY(-170%) scale(0.85);
  color: #DC2626;
}


.error-message {
  color: #EF4444;
  font-size: 0.75rem;
  margin-top: 0.25rem;
}

.bt-xemthem-container {
    display: flex;
    justify-content: center;
}

.bt-xemthem {
    padding: 0.5em 2em; /* Thiết lập padding cho nút */
    font-size: 1em; /* Thiết lập kích thước font */
    background-color: #9a0a11; /* Màu nền đỏ */
    border: 0.1em solid #9a0a11; /* Border màu đỏ */
    color: white; /* Màu chữ trắng */
    cursor: pointer;
    overflow: hidden;
    transition: color 0.5s, background-color 0.5s; /* Thêm transition cho màu và nền */
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
    transition: left 0.5s; /* Thêm transition cho left */
}

.bt-xemthem:hover::before {
    left: 0; /* Khi hover, dịch chuyển pseudo-element từ trái vào trong */
}

.bt-xemthem:hover {
    color: #9a0a11; /* Khi hover, chữ chuyển sang màu đỏ */
    background-color: transparent; /* Khi hover, chuyển từ đỏ sang trong suốt */
    transform: scaleX(1); /* Bắt đầu với chiều rộng 0 */
    transform-origin: left; 
}

.social-button {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.3s ease;
}

.social-button svg {
    width: 24px;
    height: 24px;
}

.register-link {
    transition: color 0.3s ease; /* Thêm transition cho màu chữ */
}

.register-link:hover {
    color: #9a0a11; /* Màu chữ khi hover */
}

.register-link svg {
    transition: transform 0.3s ease; /* Thêm transition cho transform */
}

.register-link:hover svg {
    transform: translateX(5px); /* Dịch chuyển svg sang phải khi hover */
}

a.text-red-600:hover {
    text-decoration: underline;
}
</style>
