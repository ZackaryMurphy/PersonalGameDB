var db;

function DB_Info(cols) {
	this._columns = cols
	this.length = cols.length;
	this.getColName = function(index) {
		if (index < 0 || index > this.length) {
			return null;
		}
		return this._columns[index];
	}
	this.getCols = function() {
		return this._columns;
	}
}

function composeDropdownOptions(xmlElement) {
	var optionArray = [];
	$(xmlElement).find('option').each(function() {
		optionArray.push( {value: $(this).find('value').text(), label: $(this).find('option_label').text()} );
	});
	return optionArray;
}

function composeOptionElements(optionArray) {
	var returnString = '';
	optionArray.forEach(function(opt) {
		returnString += ('<option value="' + opt.value + '">' + opt.label + '</option>');
	});
	return returnString;
}

function composeRadioButtons(xmlElement, id, type) {
	var returnString = '';
	$(xmlElement).find('rbutton').each(function() {
		var checked = ($(this).find('checked').text() === 'true') ? 'checked' : '';
		returnString += ('<input type="' + type + '" name="' + id + '" value="' + $(this).find('value').text() + '" ' + checked + '>' + $(this).find('radio_label').text() + '<br>');
	});
	return returnString;
}

function composeInputElement(xmlElement) {
	var id = $(xmlElement).find('id').text();
	var type = $(xmlElement).find('type').text();
	var label = $(xmlElement).find('label').text();
	switch(type) {
		case "checkbox":
		case "text":
			return label + '<br><input id="' + id + '" type="' + type + '" class="zpgdbIn"></input><br><br>';
		case "select":
			var opts = composeDropdownOptions(xmlElement);
			return label + '<select id="' + id + '" class="zpgdbIn">' + composeOptionElements(opts) + '</select><br><br>';
		case "radio":
			return label + '<br>' + composeRadioButtons(xmlElement, id, type);
		default:
			console.log("ERROR: Unable to initialize element of type: "+ type);
	}
}

function prepareSearchButton() {
	$("#selectionSideBar").append('<button id="findButton" type="button">Find</button>')
			$("#findButton").click(function() {
				$("#outTableBody").empty();
				$.ajax({
					type: "GET",
					url: "index.php",
					data: {name: "test", cons: "test", release: "test", own: "test", spec: "test", wish: "test"},
					dataType: "json",
					success: function(result) {
						var altCounter = 0;
						$.each(result, function(index, value) {
							var rowObj = JSON.parse(value);
							var tableRow;
							if (altCounter % 2 == 1) {
								tableRow = '<tr class="alt">';
							}
							else {
								tableRow = '<tr>';
							}
							$.each(db.getCols(), function(k, v) {
								tableRow += '<td>' + rowObj[v] + '</td>';
							});
							$("#outTableBody").append(tableRow);
							altCounter++;
						});
					},
					error: function(result) {
						console.log("Error on query result.");
					}
				});
			});
}

function prepareInputSidebar(xml) {
	$(xml).find("input").each(function() {
				$("#selectionSideBar").append(composeInputElement($(this)));
			})
	prepareSearchButton();
}

function prepareOutputTable() {
	$("#mainoutdiv").append('<table id="outTable"></table>');
	$("#outTable").append('<thead id="outTableHead"></thead>');
	$("#outTableHead").append('<tr id="outTableHeadRow"></tr>');
	$.each(db.getCols(), function(index, value) {
		$("#outTableHeadRow").append('<th>' + value + '</th>');
	});
	$("#outTable").append('<tbody id="outTableBody"></tbody>');
}

$(document).ready(function() {
	db = new DB_Info(["Name", "Console", "Year", "Owned", "Special Edition", "Wishlist", "Comments"])
	$.ajax({
		type: "GET",
		url: "setup.xml",
		dataType: "xml",
		success: function(xml) {
			prepareInputSidebar(xml);
			prepareOutputTable();
		},
		error: function(err) {
			alert("Page could not be properly loaded. Please try again later.");
			console.log(err);
		}
	});
});