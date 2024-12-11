<template>
    <div class="relative flex justify-center mt-2 font-lora">
            <a :href="route('post')" class="relative block w-full group">
                <img
                    class="w-full object-cover transition-all duration-500 transform group-hover:scale-95 group-hover:blur-none"
                    src="../../../../public/images/postertintuc.jpg"
                    alt="Banner"
                />                
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-xl font-bold uppercase sm:text-3xl group-hover:opacity-0 transition-opacity duration-300">
                <div class="border-t border-white w-20 mr-2 sm:w-32"></div>
                <p class="text-sm font-bold uppercase sm:text-3xl" style="font-size: 3vw;">Tin tức</p>
                <div class="border-t border-white w-20 ml-2 sm:w-32"></div>            
                </div>
            </a>
        </div>
</template>