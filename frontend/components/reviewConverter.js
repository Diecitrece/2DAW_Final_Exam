export default function reviewConverter(reviewAverage)
{
    let reviewTotal = "<>";
    let half_stars = 0;
    let rounded = Math.floor(reviewAverage);
    if (reviewAverage > rounded) half_stars++;
    let stars = rounded;
    for(i=0; i < stars; i++)
    {
      reviewTotal += '<i className="fas fa-star"></i>';
    }
    for(i=0; i < half_stars; i++)
    {
      reviewTotal += '<i className="fas fa-star-half-alt"></i>';
    }
    return reviewTotal+="</>";
}
