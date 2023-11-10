import Head from 'next/head'
import React, { useEffect, useState } from 'react';
import styles from '../styles/Home.module.css'

export default function Home() {
  const [newsData, setNewsData] = useState();
  const [isLoading, setLoading] = useState(true);
  useEffect(() =>
    {
      let url=process.env.apiRoute + '/news';
      const response = fetch(url, 
      {
          method: "GET",
      })
      .then(response => response.json())
      .then(data =>
          {
              setNewsData(data);
              setLoading(false);
          })
      .catch(error => console.log(error));
    }, []);
  
  if(isLoading)
  {
    return (
      <div className='showBox'>
          <Head>
              <title>infoCastellón - Home</title>
              <meta charSet="utf-8"></meta>
              <link rel="icon" href="/favicon.ico" />
          </Head>
          <div className='pageTitle'>
            The latest news form Castellón de la Plana
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
            <title>infoCastellón - Home</title>
            <meta charSet="utf-8"></meta>
            <link rel="icon" href="/favicon.ico" />
        </Head>
        <div className='pageTitle'>
          The latest news form Castellón de la Plana
        </div>
        <div className={styles.page} id='page'>
          {newsData.map((item) => 
          {
            return(

              <div key={item["id"]} className={styles.new} onClick={() => {window.open(item["url"])}} title = "Haz click para saber más">
              <img src={item["img"]}/>
              <div className={styles.newContent}>
                <div>
                  <span className='font-bold'>{item["title"]}</span><br/>
                  <span className={styles.publishDate}>Fecha de publicación: {item["pubDate"].split(" ")[0]}</span>
                </div>
                <div className='overflow-x-hidden overflow-y-auto'>
                  {item["description"]}
                </div>
              </div>
            </div>
          )
          })}
        </div>
        </div>
  )
}
