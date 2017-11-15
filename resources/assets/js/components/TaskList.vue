<template>
	<div class="task-list">
		<div class="content">
			<h3 v-text="pageTitle"></h3>

            <!-- Task list -->
			<ul v-bind:class="listClass">
			    <li v-for="task in tasks"
                    v-text="task.title"
                    v-bind:key="task.id"
                    v-on:click="removeTask(task.id)">
                </li>
			</ul>

			<div class="columns">
                <!-- New task input -->
				<div class="column is-four-fifths">
					<input class="input"
                        type="text"
                        tabindex="0"
                        v-model="newTask"
                        @keyup.enter="addTask"
                        placeholder="Enter a new task">
				</div>

                <!-- Add button -->
				<div class="column">
					<button class="button is-primary"
                        style="display: block; width: 100%;"
                        v-on:click="addTask"
                        v-bind:title="buttonTitle"
                        v-bind:disabled="isDisabled">
                        Add
                    </button>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less" scoped>
	.color {
		&-high {
	    	color: red;
		}
		&-medium {
	    	color: orange;
		}
		&-low {
	    	color: green;
		}
	}
	li {
		&:hover {
			cursor: pointer;
		}
		&:hover:after {
			content: ' (remove)';
		}
	}
</style>

<script>
    import Tasks from '../repositories/Tasks.js';

    export default {
    	data() {
    		return {
    			/**
		         * Task models
		         * @type {Array}
		         */
		        tasks: Tasks.all(),

		        /**
		         * New task input string
		         * @type {String}
		         */
		        newTask: ''
    		};
    	},

        mounted() {
        	Voodu.Events.$on('tasks-changed', this.updateTasks);
        	this.focusInput();
        },

        computed: {
	        pageTitle: function() {
	            var length = this.tasks.length || 0;
	            return length + ' ' + (length === 1 ? 'Task' : 'Tasks');
	        },

	        buttonTitle: function() {
	            return (this.newTask === '') ? 'Add a task' : 'Add "' + this.newTask + '"';
	        },

	        isDisabled: function() {
	            return (this.newTask === '');
	        },

	        listClass: function() {
	            var count = this.tasks.length;
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
	         * Add input string to Tasks
	         */
	        addTask() {
	        	if (this.isDisabled) { return; }

	        	Tasks.create(this.newTask);

	            this.newTask = '';
	            this.focusInput();
	        },

	        /**
	         * Remove clicked task from list
	         * @param  {Integer} id
	         */
	        removeTask(id) {
	            Tasks.delete(id);
	            this.focusInput();
	        },

	        focusInput() {
	            document.querySelector('input').focus();
	        },

            updateTasks() {
	            this.tasks = Tasks.all();
	            console.log('Updated tasks');
            }
	    }
    };
</script>
