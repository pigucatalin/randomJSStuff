var extractedReport = $('h3.filled.clear').map(function () {
  var projectText = $(this).text().replace('Print','');
  var reportText = $(this).next().find('li.dotted_border_bottom div:nth-of-type(1)').map(function () {
    var hoursText = $(this).text();
    var dateText = $(this).next().text();
    var expText = $(this).next().next().text();
    return dateText.concat('\t', projectText, '\t', expText, '\t', hoursText);
  }).get().join('\n');
  return reportText;
}).get().join('\n');



console.log(extractedReport);
