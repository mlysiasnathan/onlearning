<template>
    <div class="alert alert-dismissible fade show" :class="type" v-if="alertActive">{{ countdown }}</br>
      <h6 class="small">{{ message}}</h6>
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</template>

<script>
    export default{
        props: {
            type: {type: String, default: 'alert-primary'},
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
    }

</script>