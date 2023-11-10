import Head from 'next/head'
import styles from '../styles/Reviews.module.css'
import React, { useContext, useEffect, useState } from 'react';
import Link from 'next/link';
import { useRouter } from 'next/router'
import reviewConverter from '../components/reviewConverter';


export default function Reviews() {

    const [reviewData, setReviewData] = useState(null);
    const [isLoading, setLoading] = useState(true);
    const router = useRouter()
    const received = router.query;
        useEffect(() =>
        {
            if(router.isReady)
            {
                let url=process.env.apiRoute + '/reviews_restaurant/'+received.restaurant_id;
                setLoading(true)
                const response = fetch(url, 
                {
                    method: "GET",
                })
                .then(response => response.json())
                .then(data =>
                {
                    setReviewData(data);
                    setLoading(false);
                })
                .catch(error => console.log(error));
            }
        }, [router.isReady]);
    if(isLoading)
    {
        return (
        <div className='showBox'>
            <Head>
                <title>infoCastellón - {received.restaurant_name}</title>
                <meta charSet="utf-8"></meta>
                <link rel="icon" href="/favicon.ico" />
            </Head>
            <div className='pageTitle'>
            Reviews for "{received.restaurant_name}"    ||   <span className='text-yellow-400'>{reviewConverter(received.review_average)}</span> ||   {received.numReviews} reviews
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
            <title>infoCastellón - {received.restaurant_name}</title>
            <meta charSet="utf-8"></meta>
            <link rel="icon" href="/favicon.ico" />
        </Head>
        <div className='pageTitle'>
        Reviews for "{received.restaurant_name}"    ||   <span className='text-yellow-400'>{reviewConverter(received.review_average)}</span> ||   {received.numReviews} reviews
        </div>
        <div className={styles.page} id='page'>
        {reviewData.map((item) => 
        {
            let reviewStar = reviewConverter(item["punctuation"])
            return(
                <div key={item["id"]} className={styles.review}>
                    <div className={styles.top}>
                        <div className = {styles.name}>
                            By: {item['email']}
                        </div>
                        <div className={styles.punctuation}>
                            <div className='whitespace-nowrap'>{reviewStar} || {item['punctuation']}</div><br/>
                            <div className='whitespace-nowrap'>{item["updated_at"]["date"].split(" ")[0]}</div>
                        </div>
                    </div>
                    <div className={styles.bottom}>
                        <div className='w-full overflow-x-hidden overflow-y-auto'>
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
