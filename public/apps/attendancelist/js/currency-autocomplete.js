$(function(){
     
                           // alert(d);
                           var currencies = [
                                { value: 'Afghan afghani', data: 'AFN' },
                                { value: 'Albanian lek', data: 'ALL' },
                                { value: 'Algerian dinar', data: 'DZD' },
                                { value: 'European euro', data: 'EUR' },
                                { value: 'Angolan kwanza', data: 'AOA' },  
                                { value: 'Su Su', data: 'AOA' }, 


                              ];

                              // setup autocomplete function pulling from currencies[] array
                              $('#autocomplete').autocomplete({
                                lookup: currencies,
                                onSelect: function (suggestion) {
                                  var thehtml = '<strong>Currency Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
                                  $('#outputcontent').html(thehtml);
                                }
                              });
                      
});
