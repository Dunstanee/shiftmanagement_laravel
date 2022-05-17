var htmlTableToExcel= function(tableId, fileName = ''){
    var excelFileName='excel_table_data';
    var TableDataType = 'application/vnd.ms-excel';
    var selectTable = document.getElementById(tableId);
    var htmlTable = selectTable.outerHTML.replace(/ /g, '%20');
    
    filename = filename?filename+'.xlsx':excelFileName+'.xlsx';
    var excelFileURL = document.createElement("a");
    document.body.appendChild(excelFileURL);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', htmlTable], {
            type: TableDataType
        });
        navigator.msSaveOrOpenBlob( blob, fileName);
    }else{
        
        excelFileURL.href = 'data:' + TableDataType + ', ' + htmlTable;
        excelFileURL.download = fileName;
        excelFileURL.click();
    }
}