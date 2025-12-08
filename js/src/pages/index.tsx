import { useRef, useEffect, useState } from 'react'
import bg from '@/assets/images/bg.png'
import { AbsImage, ListDataItem, MapIcon } from '@/components'
import { LIST_DATA, MAP_DATA } from '@/utils'

function DefaultPage() {

	const allMaps = MAP_DATA.reduce((acc, item) => {
		const formatedMaps = item.maps.map(mapItem => ({
			...mapItem,
			building: item.building,
		}))
		return [...acc, ...formatedMaps]
	}, [] as {
		postId: number,
		top: number,
		left: number,
		building: string,
	}[])
	const bgRef = useRef<HTMLDivElement>(null)
	const [height, setHeight] = useState('0rem')

	useEffect(() => {
		if (!bgRef.current) {
			setHeight('auto')
			return
		}

		setHeight(`${bgRef.current.clientHeight}px`)

	}, [bgRef])

	return (
		<div className="sh-flex">
			<div ref={bgRef} className="sh-w-[80%] sh-aspect-[1.814143] sh-bg-cover sh-bg-no-repeat sh-bg-center sh-relative" style={{
				backgroundImage: `url(${bg})`,
			}}>

				<AbsImage
					className='building1'
					width={28}
					top={65}
					left={17}
				/>

				<AbsImage
					className='building2'
					width={30}
					top={41}
					left={54}
				/>

				<AbsImage
					className='building3'
					width={29}
					top={42}
					left={74}
				/>

				{allMaps.map(({ postId, top, left, building }) => (
					<MapIcon
						key={`${postId}${top}${left}`}
						building={building}
						postId={postId}
						top={top}
						left={left}
					/>
				))}

			</div>
			<div className="sh-flex-1 sh-bg-white sh-p-4 sh-overflow-y-auto" style={{
				height,
			}}>
				{
					LIST_DATA.map((list) => (
						<ListDataItem
							key={list.postId}
							{...list} />
					))
				}
			</div>
		</div>
	)
}

export default DefaultPage
