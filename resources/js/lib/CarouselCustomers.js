// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/css';

export default function carouselCustomers() {
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        effect: "coverflow",
        grabCursor: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 0,
            slideShadows: false,
        },
    });
}
