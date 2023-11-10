import { data } from 'autoprefixer';
import Head from 'next/head'
import React, { useEffect, useState } from 'react';
import styles from '../styles/gas_stations.module.css'

export default function Home() {
  const [gsData, setGSData] = useState();
  const [isLoading, setLoading] = useState(true);
  useEffect(() =>
    {
      let url=process.env.apiRoute + '/gas_stations';
      const response = fetch(url, 
      {
          method: "GET",
      })
      .then(response => response.json())
      .then(data =>
          {
              setGSData(data);
              setLoading(false);
          })
      .catch(error => console.log(error));
    }, []);
  
  if(isLoading)
  {
    return (
      <div className='showBox'>
          <Head>
              <title>infoCastellón - Gas Stations</title>
              <meta charSet="utf-8"></meta>
              <link rel="icon" href="/favicon.ico" />
          </Head>
          <div className='pageTitle'>
            Gas Stations in Castellón de la Plana
          </div>
          <div className={styles.station} id='page'>
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
            <title>infoCastellón - Gas Stations</title>
            <meta charSet="utf-8"></meta>
            <link rel="icon" href="/favicon.ico" />
        </Head>
        <div className='pageTitle'>
          Gas Stations in Castellón de la Plana
        </div>
        <div className={styles.page} id='page'>
          {gsData.map((item) => 
          {
            return(

              <div key={item["id"]} className={styles.station}>
                <span className = {styles.name}>
                  Gasolinera: <br/>"{item['label']}"
                </span>
                <hr/><hr/><hr/>
                <span className = {styles.address}>
                  Dirección: <br/>
                  <span onClick={() => 
                  {
                    window.open("http://maps.google.com/maps?q="+item["address"]);
                  }} className='underline hover:cursor-pointer hover:text-violet-900' title='Haz click para abrir google maps'>
                    {item["address"]}
                  </span>
                </span>
              </div>
          )
          })}
        </div>
        </div>
  )
}
