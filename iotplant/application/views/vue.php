<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	
</head>
<body>
	<div id="app">
	  <p>{{ message }}</p>
	</div>

	<div id="app-2">
	  <span v-bind:title="message">
	    Hover your mouse over me for a few seconds
	    to see my dynamically bound title!
	  </span>
	</div>
	<div id="app-3">
	  <p v-if="seen">Now you see me</p>
	</div>
	<div id="app-4">
	  <ol>
	    <li v-for="todo in todos">
	      {{ todo.text }}
	    </li>
	  </ol>
	</div>

	<div id="app-5">
	  <p>{{ message }}</p>
	  <button v-on:click="reverseMessage">Reverse Message</button>
	</div>
	<div id="app-6">
	  <p>{{ message }}</p>
	  <input v-model="message">
	</div>

	<div id="app-7">
	<p>{{ message }}</p>
	  <div v-for="item in items">{{ item }}</div>
	</div>

	<div id="tes">
		
	</div>
	<script src="https://unpkg.com/vue"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.3"></script>
	<script>
	 // axios.get('http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V0')
	 	// Make a request for a user with a given ID



		var app = new Vue({
		  el: '#app',
		  data: {
		    message: 'Hello Vue.js!'
		  }
		})

		var app2 = new Vue({
		  el: '#app-2',
		  data: {
		    message: 'You loaded this page on ' + new Date()
		  }
		})

		var app3 = new Vue({
		  el: '#app-3',
		  data: {
		    seen: true
		  }
		})

		var app4 = new Vue({
		  el: '#app-4',
		  data: {
		    todos: [
		      { text: 'Learn JavaScript' },
		      { text: 'Learn Vue' },
		      { text: 'Build something awesome' }
		    ]
		  }
		})

		var app5 = new Vue({
		  el: '#app-5',
		  data: {
		    message: ''
		  },
		  methods: {
		    reverseMessage: function () {
		      this.message = this.message.split('').reverse().join('')
		    }
		  },

		  created() {
    axios.get('http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V1')
    .then(response => {
      // JSON responses are automatically parsed.
      this.message = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })
		}
	})


		var app6 = new Vue({
		  el: '#app-6',
		  data: {
		    message: ''
		  },

		  created: function() {
    this.$http.get('http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V1')
      .then( function(response) { 
        this.data = response.json();
      }) 
      .catch( function(error) { 
        console.error(error); 
      });
    }

		})

	</script>
</body>
</html>