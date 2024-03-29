/**
* Template Name: Resi - v4.7.0
* Template URL: https://bootstrapmade.com/resi-free-bootstrap-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 16
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Porfolio isotope and filter
   */
  window.addEventListener('load', () => {
    let portfolioContainer = select('.portfolio-container');
    if (portfolioContainer) {
      let portfolioIsotope = new Isotope(portfolioContainer, {
        itemSelector: '.portfolio-item'
      });

      let portfolioFilters = select('#portfolio-flters li', true);

      on('click', '#portfolio-flters li', function(e) {
        e.preventDefault();
        portfolioFilters.forEach(function(el) {
          el.classList.remove('filter-active');
        });
        this.classList.add('filter-active');

        portfolioIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });

      }, true);
    }

  });

  /**
   * Initiate portfolio lightbox 
   */
  const portfolioLightbox = GLightbox({
    selector: '.portfolio-lightbox'
  });

  /**
   * Portfolio details slider
   */
  new Swiper('.portfolio-details-slider', {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });
})()

// vueJs CODE====================================================================================================================================================================
// LOG IN
let alertVue = Vue.component('vue-alert', {
  props: {
    type: {type: String, default: 'bg-danger'},
    message: {type : String, default: 'Alert found'},
    start: {type: Number, default: 4}
  },
  data: function(){
      return {
        countdown : 0,
        alertActive: false,
      }
  },
  mounted: function() {
      this.countdown = this.start
      this.alertActive = true
      this.$countdown = this.countdown * 1000
      setTimeout(() => {
          this.alertActive = false
      }, this.$countdown);
      this.$timer = setInterval(() => {
          this.countdown--
          if(this.countdown <= 0){
              clearInterval(this.$timer)
              this.countdown = 6
          }
      }, 1000);
  },
  template: 
  `
  <transition name="fade" appear>
      
      <div class="toast text-white border-4 show mt-2" :class="type" v-if="alertActive" role="alert" aria-live="assertive" aria-atomic="true" style="border-radius: 50px">
        <div class="d-flex">
          <div class="toast-body">
            <span style="font-size: 13px">{{ countdown }} <strong> {{ message}}</strong></span> 
          </div>
          <button @click="() =>  alertActive = false" type="button" class="btn-close me-3 m-auto border-3 border-light rounded-circle" ></button>
          
        </div>
      </div>

    </transition>
    `,
})
// import {alertVue} from './vue-components/vue-alert.vue';

new Vue({
  el: '#message-active',
  components: { alertVue },
})

let vm = new Vue ({
  el: '#login',
  data:{
      email : '',
      password: '',
      type: 'password',
      emailError: false,
      passwordError: false,
      muted: true,
      signup: false,
      icon: 'bi bi-eye-slash ShowHidePwd'
  },
  methods:{
      showPassword(){
          if(this.showPsd){
              this.showPsd = false
              this.type = 'password'
              this.icon = 'bi bi-eye-slash ShowHidePwd'
          }else{
              this.showPsd = true
              this.type = 'text'
              this.icon = 'bi bi-eye ShowHidePwd'
          }
      },
      loginSingUp(){
        return this.signup ? 'active' : ''
      },
      link(){
        return this.signup ? this.signup = false : this.signup = true
      }
  },

  watch:{
      email(value){
          if(value == ''){
              this.emailError = 'Field email must be filled'
              this.muted = true
          }else if(!value.includes('&')){
              this.emailError = 'Field email must contain & '
              this.muted = true
          }else{
              this.emailError = false,
              this.muted = false
          }
      },
      password(passwordValue){
          if(passwordValue == ''){
              this.passwordError = 'Field password must be filled'
              this.muted = true
          }else if(passwordValue.length < 3){
              this.passwordError = 'Field password must be at least 3 characters '
              this.muted = true
          }
          else{
              this.passwordError = false,
              this.muted = false
          }
      }
      
  }

})