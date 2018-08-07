library(rvest)
for(i in 1630:1682)
{
id=imdbids$imdbid[i];
x=paste("http://www.imdb.com/title/",id,sep="")
movie<-read_html(x)
movie %>% html_node("#titleYear a") %>% html_text()


a1=movie %>% html_node(".txt-block:nth-child(4)") %>% html_text()
a2=movie %>% html_node("#titleDetails h2+ .txt-block") %>% html_text()
if(grepl("Country",a1))
{
a11=gsub("\\s","",a1)
}
else
{
a11=gsub("\\s","",a2)
}
Country=gsub("Country:","",a11)

a2=movie %>% html_node(".txt-block~ .canwrap , .txt-block~ .canwrap a , .txt-block~ .canwrap .inline") %>% html_text()
a21=gsub("\\s","",a2)
Genres=gsub("Genres:","",a21)

a3=movie %>% html_node(".summary_text+ .credit_summary_item") %>% html_text()
a31=gsub("\\s","",a3)
a32=gsub("Director:","",a31)
Directors=gsub("Directors:","",a32)

a4=movie %>% html_node(".credit_summary_item:nth-child(3)") %>% html_text()
a41=gsub("\\s","",a4)
a42=gsub("Writers:","",a41)
a43=gsub("Writer:","",a42)
k = unlist(strsplit(a43, split='|', fixed=TRUE))[1]

Writers=gsub("\\s*\\([^\\)]+\\)","",k)

a5=movie %>% html_node(".credit_summary_item~ .credit_summary_item+ .credit_summary_item") %>% html_text()
a51=gsub("\\s","",a5)
a52=gsub("Stars:","",a51)
a53 = unlist(strsplit(a52, split='|', fixed=TRUE))[1]
Stars=gsub("\\s*\\([^\\)]+\\)","",a53)

Ratings=movie %>% html_node("strong span") %>% html_text()
Name=movie %>% html_node("#ratingWidget strong") %>% html_text()
Year=movie %>% html_node("#titleYear a") %>% html_text()
Story=movie %>% html_node("#titleStoryLine p") %>% html_text()
temp=data.frame(id,Country,Genres,Directors,Writers,Stars,Ratings,Name,Year,Story)

moviefeats=rbind(moviefeats,temp)
}