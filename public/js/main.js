const { createApp, ref } = Vue

/** @type {import('vue').App} */
const app = createApp({
  data() {
    /** @type {import('vue').Ref<number>} */
    const counter = ref(0)

    /** @type {import('vue').Ref<string>} */
    const message = ref('Hello from Vue.js!')

    return { counter, message }
  },

  methods: {
    increment() {
      this.counter++
    },
    decrement() {
      this.counter--
    },
  },
})

app.mount('#app')
