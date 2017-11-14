<template>

	<div class="task-list">
		<div class="content">
			<h3 v-text="pageTitle"></h3>
            
			<ul v-bind:class="listClass">
			    <li v-for="name in names" v-text="name" v-on:click="removeName"></li>
			</ul>

			<div class="columns">
				<div class="column is-four-fifths">
					<input class="input" type="text" tabindex="0" v-model="newName" @keyup.enter="addName" placeholder="Enter a new task">
				</div>

				<div class="column">
					<button style="display: block; width: 100%;" class="button is-primary" v-on:click="addName" v-bind:title="buttonTitle" v-bind:disabled="isDisabled">Add</button>
				</div>
			</div>
		</div>
	</div>

</template>

<style lang="less" scoped>

	.color-high {
	    color: red;
	}
	.color-medium {
	    color: orange;
	}
	.color-low {
	    color: green;
	}
	li:hover {
	    cursor: pointer;
	}
	li:hover:after {
	    content: ' (remove)';
	}

</style>

<script>

    export default {
    	data() {
    		return {
    			/**
		         * User names
		         * @type {Array}
		         */
		        names: (typeof window.localStorage.names !== 'string') ? [] : JSON.parse(window.localStorage.names),

		        /**
		         * New name input string
		         * @type {String}
		         */
		        newName: ''
    		};
    	},

        mounted() {
        	this.focusInput();
        },

        computed: {
	        pageTitle: function() {
	            var length = this.names.length;
	            return length + ' ' + (length === 1 ? 'Task' : 'Tasks');
	        },

	        buttonTitle: function() {
	            return (this.newName === '') ? 'Add a name' : 'Add "' + this.newName + '"';
	        },

	        isDisabled: function() {
	            return (this.newName === '');
	        },

	        listClass: function() {
	            var count = this.names.length;
	            if (count > 5) {
	                return 'color-high';
	            }
	            if (count > 3) {
	                return 'color-medium';
	            }
	            return 'color-low';
	        }
    	},

	    methods: {
	        /**
	         * Add input string to list
	         */
	        addName() {
	        	if (this.isDisabled) { return; }
	            this.names.push(this.newName);
	            this.newName = '';
	            this.focusInput();
	        },

	        /**
	         * Remove clicked name from list
	         * @param  {Event} e
	         */
	        removeName(e) {
	            this.names.splice(this.names.indexOf(e.target.innerText), 1);
	            this.focusInput();
	        },

	        focusInput() {
	            document.querySelector('input').focus();
	        }
	    },

	    watch: {
	        names: function(data) {
	            window.localStorage.names = JSON.stringify(data);
	        }
	    }
    };

</script>
