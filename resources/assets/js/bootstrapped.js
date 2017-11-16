const data = window.Voodu.bootstrapped;

export default {
	get (module, key) {
		if (!data.hasOwnProperty(module)) {
			return;
		}

		if (!data[module][key]) {
			return;
		}

		return data[module][key];
	}
}