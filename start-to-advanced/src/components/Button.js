import React from 'react'

export default function Button({sethidecom,hidecom}) {
  return (
    <>
    <button onClick={()=>sethidecom(!hidecom)}>Click me{hidecom?' Hide':' Show'}</button>    
    </>
  )
}
