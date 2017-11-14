// import components
import TasksSection from './components/TasksSection.vue';
import DashboardSection from './components/DashboardSection.vue';

// export mappings
export default [
    {
        name: 'DashboardSection',
        path: '/',
        component: DashboardSection
    },
    {
        name: 'TasksSection',
        path: '/tasks',
        component: TasksSection
    }
]