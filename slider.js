jQuery(document).ready(function ($) {
    // Initialize the slider
    $('.wprt-testimonials').each(function () {
        var $slider = $(this);
        var $testimonials = $slider.find('.wprt-testimonial');
        var currentIndex = 0;

        function showTestimonial(index) {
            $testimonials.hide().eq(index).fadeIn();
        }

        function slideNext() {
            currentIndex = (currentIndex + 1) % $testimonials.length;
            showTestimonial(currentIndex);
        }

        function startSlider() {
            showTestimonial(currentIndex);
            setInterval(slideNext, 5000); // Change slide every 5 seconds
        }

        startSlider();
    });
});
