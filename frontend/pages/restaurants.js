import Head from 'next/head'
import styles from '../styles/Restaurants.module.css'
import React, { useContext, useEffect, useState } from 'react';
import Link from 'next/link';
import reviewConverter from '../components/reviewConverter';

export default function Restaurants() {

  const [restaurantData, setRestaurantData] = useState(null);
  const [isLoading, setLoading] = useState(true);
  useEffect(() =>
    {
      let url=process.env.apiRoute + '/restaurants';
      setLoading(true)
      const response = fetch(url, 
      {
          method: "GET",
      })
      .then(response => response.json())
      .then(data =>
          {
            setRestaurantData(data);
            setLoading(false);
          })
      .catch(error => console.log(error));
    }, []);
  if(isLoading)
  {
    return (
      <div className='showBox'>
          <Head>
              <title>infoCastellón - Restaurants</title>
              <meta charSet="utf-8"></meta>
              <link rel="icon" href="/favicon.ico" />
          </Head>
          <div className='pageTitle'>
          The Top restaurants from Castellón de la Plana
          </div>
          <div className={styles.page} id='page'>
            <div className='loading'>
              <i className="fas fa-spinner" id='spinner'></i>
            </div>
          </div>
      </div>
    )  
  }
  return (
    <div className='showBox'>
        <Head>
            <title>infoCastellón - Restaurants</title>
            <meta charSet="utf-8"></meta>
            <link rel="icon" href="/favicon.ico" />
        </Head>
        <div className='pageTitle'>
        The Top restaurants from Castellón de la Plana
        </div>
        <div className={styles.page} id='page'>
          {restaurantData.map((item) => 
          {
            let reviewAverage = reviewConverter(item["reviewAverage"]);
            return(
              <div className={styles.restaurant} key={item["id"]}>
                <div className={styles.top}>
                  <div className = {styles.name}>
                    {item['name']}
                  </div>
                  <div className={styles.punctuation}>
                    {reviewAverage} || Number of reviews: {item['numReviews']}<br/>
                    <span onClick={() => 
                    {
                      window.open("http://maps.google.com/maps?q="+item["address"]);
                    }} className='underline hover:cursor-pointer hover:text-violet-900' title='Haz click para abrir google maps'>
                      {item["address"]}
                    </span>
                  </div>
                </div>
                <div className={styles.bottom}>
                  <div className='w-full overflow-x-hidden overflow-y-auto'>
                    {item["description"]}
                  </div>
                  <div className={styles.buttons}>
                    <div className='bg-blue-500 hover:border-4 hover:border-violet-900 hover:cursor-pointer'>
                    <Link
                      href={{
                        pathname: '/reviews',
                        query: { restaurant_id: item["id"], restaurant_name: item["name"], review_average : item["reviewAverage"], numReviews : item["numReviews"]}
                      }}
                    >
                      Reviews
                    </Link>
                    </div>
                    <div className='bg-green-500 hover:border-4 hover:border-violet-900 hover:cursor-pointer'>
                    <Link
                      href={{
                        pathname: '/createReview',
                        query: { restaurant_id: item["id"], restaurant_name: item["name"]}
                      }}
                    >
                      Rate
                    </Link>
                    </div>
                  </div>
                </div>
              </div>
            )
          })}
        </div>
    </div>
  )
}
