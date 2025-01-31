"use strict";
Handlebars.registerHelper('formcomponentValue', function(value, resolvedObject, resolvedObjectField, defaultValue, options) {

	// If the value has been set, return that value already, even if it is empty
	if (typeof value !== 'undefined') {

		return apply_formcomponentvalue_options(value, options);
	}

	// If the field has been provided and is not empty, and the resolvedObject exists (aka it has been set in the context), then return that field from the resolvedObject
	if (resolvedObject && resolvedObjectField) {

		return apply_formcomponentvalue_options(resolvedObject[resolvedObjectField], options);
	}

	// If there is a default value, use it next
	if (typeof defaultValue !== 'undefined') {

		return apply_formcomponentvalue_options(defaultValue, options);
	}

	// Return nothing through null, since it works for both multiple ([]) / single ("") values
	return null;
});

function apply_formcomponentvalue_options(value, options) {

	// Allow MultipleInput to obtain the values for the subfields (eg: DateRange from/to values)
	var subfields = options.hash.subfields || [];
	jQuery.each(subfields, function(index, subfield) {

		value = value[subfield];
	});

	return value;
}