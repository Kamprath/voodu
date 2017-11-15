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
                        placeholder="Enter a new task"
                        :disabled="isLoading">
				</div>

                <!-- Add button -->
				<div class="column">
					<button :class="{ 'button': true, 'is-primary': true, 'is-loading': isLoading }"
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
		        tasks: Tasks.all(this.updateTasks),

		        /**
		         * New task input string
		         * @type {String}
		         */
		        newTask: '',

                isLoading: true
    		};
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
	            return (this.newTask === '' || this.isLoading);
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

	        	Tasks.create(this.newTask, function(tasks) {
	        	    this.updateTasks(tasks)
                    this.newTask = '';
                }.bind(this));

                this.isLoading = true;
	        },

	        /**
	         * Remove clicked task from list
	         * @param  {Integer} id
	         */
	        removeTask(id) {
	            this.isLoading = true;
	            Tasks.delete(id, this.updateTasks);
	            this.focusInput();
	        },

	        focusInput() {
	            window.setTimeout(function() {
	                document.querySelector('input').focus();
                }, 50);
	        },

            updateTasks(tasks) {
                this.tasks = tasks;
                this.isLoading = false;
                this.focusInput();
            }
	    }
    };
</script>
