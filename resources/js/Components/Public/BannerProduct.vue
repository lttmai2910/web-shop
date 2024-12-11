<template>
    <!-- <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
      <div class="flex flex-col items-center justify-between lg:flex-row">
        <div class="mb-10 lg:max-w-lg lg:pr-5 lg:mb-0">
          <div class="max-w-xl mb-6">
            <div>
                <p class="inline-block px-4 py-px mb-4 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-red-500">
                    New Collection
                </p>
            </div>
            <h2 class="max-w-lg mb-4 font-lora text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl sm:leading-none">
              RENEW 2024 <br class="hidden md:block" />
              COLLECTION
            </h2>
            <p class="text-sm text-gray-700 md:text-base">
                CHECK OUT THE OUTFITS WITH NEW DESIGN
            </p>
          </div>
          <div class="flex flex-col items-center md:flex-row">
            <a href="/" 
            class="inline-flex items-center justify-center w-full h-12 px-6 mb-3 font-medium tracking-wide text-white transition duration-200 rounded shadow-md md:w-auto md:mr-4 md:mb-0 bg-red-500 hover:bg-red-600 focus:shadow-outline focus:outline-none sm:justify-center">
              <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                Shopping Now
              </span>
            </a>
          </div>
        </div>
        <div class="relative lg:w-1/2">
          <img class="object-cover w-full h-56 rounded-lg shadow-xl sm:h-96" src="../../../../public/images/img1.jpg" alt="" />
        </div>
      </div>
    </div> -->
  <div class="relative flex justify-center mt-2 font-lora">
    <a :href="route('product')" class="relative block w-full group">
        <img class="w-full object-cover transition-all duration-300 group-hover:blur-none" src="../../../../public/images/banner.png" alt="Banner">
        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold uppercase sm:text-3xl group-hover:opacity-0 transition-opacity duration-300">
          <div class="border-t border-white w-20 mr-2 sm:w-32"></div>
          <p class="text-sm font-bold uppercase sm:text-3xl" style="font-size: 3vw;">Sản phẩm</p>
          <div class="border-t border-white w-20 ml-2 sm:w-32"></div>            
        </div>
    </a>
  </div>
</template>
  