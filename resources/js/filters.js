import Vue from "vue"

// Filters
Vue.filter('uppercase' , function(value){
    return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.filter('allupercase' , function(value){
    return value.toUpperCase()
})