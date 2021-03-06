#Builds xml with values for factory output along with their names. It also creates
#a link to javascript function updateChart
#The values required for building the xml is obtained from the array factory_data
#present in the controller action "default".
#It expects an array in which each element as 
#a hash with values for "factory_name","factory_output" and "factory_id"
xml = Builder::XmlMarkup.new
xml.chart(:caption=>'Factory Output report', :subCaption=>'By Quantity', :pieSliceDepth=>'30', :showBorder=>'1', :formatNumberScale=>'0', :numberSuffix=>' Units', :animation=>@animate_chart) do
	for item in @factory_data
		xml.set(:label=>item[:factory_name],:value=>item[:factory_output],:link=>'javaScript:updateChart('+item[:factory_id].to_s + ')')
	end
end
