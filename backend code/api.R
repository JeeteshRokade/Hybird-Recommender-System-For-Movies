#* @get /addrating
addrating=function(userid,movieid,rating)
{
  row=c(as.numeric(userid),as.numeric(movieid),as.numeric(rating))
  print(class(row))
  ratings=rbind(ratings,row)
  library(future)
  plan(multiprocess)
  assign('ratings',ratings,envir=.GlobalEnv)
  reload()

  return()
  
}


#* @get /adduser
adduser=function(userid,age,gen,occup,zip)
{
  
  row=c(userid=userid,age=age,gender=as.character(gen),occupation=as.character(occup),zipcode=as.character(zip))
  print(row)
  userinfo=rbind(userinfo,row)
  assign('userinfo',userinfo,envir=.GlobalEnv)
  
  
}


#* @get /buildmodel
buildmodel=function()
{
  source("C:/Users/Felix/Desktop/research papers/optimizedworkingcodereadytodeploy.r", echo = TRUE)
}

#* @get /generaterecommendations
generaterecommendations=function(userid)
{
  
  userid=as.numeric(userid)
  result=generaterecomm(userid)
  return(result)
  
}

#* @get /similarmovies

findsimilarmoviesFW2=function(itemid=1)
{
  IXFW2=as.data.frame(IXFW2)
  simmovies=data.frame(matrix(nrow=10,ncol=2))
  for(i in 1:10)
  {
    simmovies[i,1]=IXFW2[itemid,i]
    simmovies[i,2]=as.character(titles[IXFW2[itemid,i],1])
  }
  colnames(simmovies)=c('mid','Title')
  
  
  
  return (simmovies);
}

