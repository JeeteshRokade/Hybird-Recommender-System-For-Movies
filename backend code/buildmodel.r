#ratings=read.csv(file="C:/Users/Felix/Desktop/ml-100k/u.data",header=FALSE,sep="\t")
ratings=ratings[,1:3]
#ratings=rbind(ratings,c(944,228,5))
colnames(ratings)=c("userid","itemid","rating")
library(Matrix)
ratingmatrix <- sparseMatrix(i = ratings$userid,
                             j = ratings$itemid,
                             x = ratings$rating)
ratingmatrix=as.matrix(ratingmatrix)	
ratingmatrix[which(ratingmatrix==0)]=NA					 
rowmeansx=rowMeans(ratingmatrix,na.rm=TRUE)
colmeansx=colMeans(ratingmatrix,na.rm=TRUE)
meanx=mean(ratingmatrix,na.rm=TRUE)


nusers=nrow(ratingmatrix)
nitems=ncol(ratingmatrix)
nratings=nrow(ratings)

tempx=ratings$userid
tempy=ratings$itemid
UA=data.frame(rowmeansx[tempx])
IA=data.frame(colmeansx[tempy])

OA=data.frame(matrix(nrow=nratings,ncol=1))
OA[1:nratings,1]=1
colnames(OA)=c('V1')
OA=OA*meanx

temp2=data.frame(UA,IA,OA)


R3=ratings$rating
X=qr.solve(temp2,R3)
a=X[1];
b=X[2];
c=X[3];


predRat=data.frame(a*UA+b*IA+c*OA)
normRat=data.frame(R3-predRat)

colnames(normRat)=c('ratings')

NormRat=data.frame(ratings$userid,ratings$itemid,normRat$ratings)
colnames(NormRat)=c('userid','itemid','ratings')

library(Matrix)
NormRatMatrix <- sparseMatrix(i = NormRat$userid,
                              j = NormRat$itemid,
                              x = NormRat$ratings)


#userinfo=read.csv(file="C:/Users/Felix/Desktop/ml-100k/u(1).user",header=FALSE,sep="|")
colnames(userinfo)=c("userid","age","gender","occupation","zipcode")

occupations=subset(userinfo,select=c("userid","occupation"))
occupationmatrix=as.data.frame.matrix(table(occupations))
genders=subset(userinfo,select=c("userid","gender"))
gendermatrix=as.data.frame.matrix(table(genders))
ages=subset(userinfo,select=c("userid","age"))
agematrix=as.data.frame.matrix(table(ages))

moviefeats=read.csv(file="C:/Users/Felix/Desktop/research papers/latestmoviefeatures.csv",header=TRUE,sep=",")

country <- as.data.frame(moviefeats$Country, stringsAsFactors=FALSE)
library(data.table)
country2 <- as.data.frame(tstrsplit(country[,1], '[|]', type.convert=TRUE), stringsAsFactors=FALSE)
colnames(country2) <- c(1:7)
country_list = as.character(unique(unlist(country2)))

country_list=country_list[-49]
country_list = as.data.frame(country_list)
ncountries=nrow(country_list)
country_matrix1 <- matrix(nrow=ncountries,ncol=nitems)
rownames(country_matrix1) <- country_list[,1]

colnames(country_matrix1) <- c[1:nitems]
for (i in 1:nrow(country2))
{
  for (j in 1:ncol(country2)) 
  {
    if(!is.na(country2[i,j]))
    {  
      country_matrix1[country2[i,j],i]=1   
    }
  }
}

country_matrix1[which(is.na(country_matrix1))]=0 
country_matrix1=t(country_matrix1)

movies=read.csv(file="C:/Users/Felix/Desktop/ml-100k/u.item",header=FALSE,sep="|")
titles=movies[,2]
titles=as.data.frame(titles)
dates=movies[,3]

ylist=as.data.frame(tstrsplit(dates[1:nitems], '[-]', type.convert=TRUE), stringsAsFactors=FALSE)

year_list=ylist[,3]
distyears = as.character(unique(unlist(year_list)))

distyears=data.frame(distyears)

year_matrix <- matrix(nrow=nrow(distyears),ncol=nitems)
rownames(year_matrix) <- distyears[,1]


for(i in 1:nitems)
{
  year_matrix[as.character(year_list[i]),i]=1
  
} 
year_matrix=t(year_matrix)
year_matrix[which(is.na(year_matrix))]=0

genres=movies[,6:24]
genre_names=read.csv(file="C:/Users/Felix/Desktop/ml-100k/u.genre",header=FALSE,sep="|")
genre_matrix=as.matrix(genres)
colnames(genre_matrix)=genre_names[,1]




nitems1=nrow(year_matrix)
nfeats=ncol(year_matrix)
IF1=year_matrix
Rows=rowSums(IF1)^(-0.5)
Cols=colSums(IF1)^(-0.5)

for( x in 1:nitems1)
{
  for( y in 1:nfeats)
  {
    if(IF1[x,y]!=0)
    {
      IF1[x,y]=Rows[x]*IF1[x,y]*Cols[y];
    }
  }
}
IF1=t(IF1)

nitems1=nrow(country_matrix1)
nfeats=ncol(country_matrix1)
IF2=country_matrix1
Rows=rowSums(IF2)^(-0.5)
Cols=colSums(IF2)^(-0.5)

for( x in 1:nitems1)
{
  for( y in 1:nfeats)
  {
    if(IF2[x,y]!=0)
    {
      IF2[x,y]=Rows[x]*IF2[x,y]*Cols[y];
    }
  }
}
IF2=t(IF2)

nitems1=nrow(genre_matrix)
nfeats=ncol(genre_matrix)
IF3=genre_matrix
Rows=rowSums(IF3)^(-0.5)
Cols=colSums(IF3)^(-0.5)

for( x in 1:nitems1)
{
  for( y in 1:nfeats)
  {
    if(IF3[x,y]!=0)
    {
      IF3[x,y]=Rows[x]*IF3[x,y]*Cols[y];
    }
  }
}
IF3=t(IF3)





nitems1=nrow(occupationmatrix)
nfeats=ncol(occupationmatrix)
UF1=occupationmatrix
Rows=rowSums(UF1)^(-0.5)
Cols=colSums(UF1)^(-0.5)

for( x in 1:nitems1)
{
  for( y in 1:nfeats)
  {
    if(UF1[x,y]!=0)
    {
      UF1[x,y]=Rows[x]*UF1[x,y]*Cols[y];
    }
  }
}

nitems1=nrow(gendermatrix)
nfeats=ncol(gendermatrix)
UF2=gendermatrix
Rows=rowSums(UF2)^(-0.5)
Cols=colSums(UF2)^(-0.5)

for( x in 1:nitems1)
{
  for( y in 1:nfeats)
  {
    if(UF2[x,y]!=0)
    {
      UF2[x,y]=Rows[x]*UF2[x,y]*Cols[y];
    }
  }
}

nitems1=nrow(agematrix)
nfeats=ncol(agematrix)
UF3=agematrix
Rows=rowSums(UF3)^(-0.5)
Cols=colSums(UF3)^(-0.5)

for( x in 1:nitems1)
{
  for( y in 1:nfeats)
  {
    if(UF3[x,y]!=0)
    {
      UF3[x,y]=Rows[x]*UF3[x,y]*Cols[y];
    }
  }
}

IF3=IF3*2
IF=rbind(IF1,IF2,IF3)
UF=cbind(UF1,UF2,UF3)
UF=as.matrix(UF)
w1=30
w2=20
IFW=IF*w1
UFW=UF*w2

rownames(IFW)=1:nrow(IFW)
colnames(IFW)=1:ncol(IFW)
rownames(UFW)=1:nrow(UFW)
colnames(UFW)=1:ncol(UFW)


dim1=nrow(IFW)
dim2=ncol(UFW)

Z=matrix(0,dim1,dim2)

NormRatMatrixdf=as.matrix(NormRatMatrix)



RIFW=rbind(NormRatMatrixdf,IFW)
colnames(Z)=1:ncol(Z)
UFWZ=rbind(UFW,Z)

rownames(RIFW)=1:nrow(RIFW)
colnames(RIFW)=1:ncol(RIFW)
rownames(UFWZ)=1:nrow(UFWZ)
colnames(UFWZ)=1:ncol(UFWZ)

RFW=cbind(RIFW,UFWZ)


RFW1=as.matrix(RFW)	
RFW2=as(RFW1,"dgCMatrix")
library("sparsesvd")
SVDFW2=sparsesvd(RFW2,10)	
UFW2=SVDFW2$u
SFW2=diag(SVDFW2$d)
VFW2=SVDFW2$v
UFW2=UFW2*(-1)
VFW2=VFW2*(-1)
library("expm")
library("lsa")
XFW2 = UFW2%*%sqrtm(SFW2);	
YFW2 = sqrtm(SFW2)%*%t(VFW2);
predRat4FW2=XFW2%*%YFW2

ISMFW2=matrix(0,nitems,nitems)
numItems=nitems

for (x  in 1:numItems)
{
  for (y in 1:numItems)
  {
    if (x <= y)
    {
      break;
    } 
    else
    {
      ISMFW2[x,y] = cosine(YFW2[,x],YFW2[,y])
    }
    
  }
  
}
ISMFW2=ISMFW2+t(ISMFW2)
SFW2=matrix(nrow=numItems,ncol=numItems)
for(i in 1:nitems)
{
  SFW2[,i]=sort(ISMFW2[i,],decreasing=TRUE)
  
}
SFW2=t(SFW2)
IXFW2=matrix(nrow=numItems,ncol=nitems)
for(i in 1:nitems)
{
  IXFW2[,i]=order(ISMFW2[i,],decreasing=TRUE)
  
}
IXFW2=t(IXFW2)


findsimilarmoviesFW2=function(itemid)
{
  
  for(i in 1:10)
  {
    print(titles[IXFW2[itemid,i],1])
  }
  
}



XFW2=t(XFW2)
USMFW2=matrix(0,nusers,nusers)
numUsers=nusers

for (x  in 1:numUsers)
{
  for (y in 1:numUsers)
  {
    if (x <= y)
    {
      break;
    } 
    else
    {
      USMFW2[x,y] = cosine(XFW2[,x],XFW2[,y])
    }
  }
}


USMFW2=USMFW2+t(USMFW2)
USFW2=matrix(nrow=numUsers,ncol=numUsers)
for(i in 1:nusers)
{
  USFW2[,i]=sort(USMFW2[i,],decreasing=TRUE)
  
}
USFW2=t(USFW2)
UXFW2=matrix(nrow=nusers,ncol=nusers)
for(i in 1:nusers)
{
  UXFW2[,i]=order(USMFW2[i,],decreasing=TRUE)
  
}
UXFW2=t(UXFW2)








