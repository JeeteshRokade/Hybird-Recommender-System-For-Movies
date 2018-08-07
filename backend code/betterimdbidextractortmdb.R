
df=data.frame(matrix(nrow=0,ncol=0))


titles=as.data.frame(titles)
colnames(titles)=c("Title")

library("TMDb")
for(i in 401:500){
   
  temp <- titles$Title[i]
year=toString(year_list[i])
title=gsub("\\s*\\([^\\)]+\\)","",as.character(temp))
newvar=search_movie(apikey, title, page = 1, include_adult = NA, language = NA, year =NA,primary_release_year = year, search_type = "phrase")

if(length(newvar$results)==0)
{
 newvar=search_movie(apikey, title, page = 1, include_adult = NA, language = NA, year =year,primary_release_year = NA, search_type = "phrase")
}

if(length(newvar$results)==0)
{
 newvar=search_movie(apikey, title, page = 1, include_adult = NA, language = NA, year =NA,primary_release_year = NA, search_type = "phrase")
}


id=newvar$results[1,]$id


var=movie(apikey, id, language = NA, append_to_response = NA)

a=data.frame(imdbid=var$imdb_id)
df=rbind(df,a)
}

a=data.frame(imdbid="tt0119432")
df=rbind(df,a)