import{r as t}from"./app-cab1f127.js";function c(r){const e=t.useRef({value:r,previous:r});return t.useMemo(()=>(e.current.value!==r&&(e.current.previous=e.current.value,e.current.value=r),e.current.previous),[r])}export{c as $};