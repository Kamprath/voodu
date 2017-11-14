import Vue from 'vue';

/**
 * Global variables accessible from anywhere within the application
 */
export default {
    /**
     * Central event bus for cross-component communication
     */
    Events: new Vue(),

    /**
     * Bootstrapped application data
     */
    bootstrapped: {}
};